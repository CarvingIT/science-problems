<?php
include_once('User.class.php');

class AuthUser extends User{

public function __construct($user_id){
    parent::__construct($user_id);
    if(!$this->isAuthUser()){
        $this->_loginRedirect();
        throw new Exception('No privileges');
    }
}

/* The following function adds a new problem.
The status will be unverified.
Logged in user will not be required to fill in captcha and other fields
like email, name etc
*/
public function submitProblem($data){
    $insert = sprintf("INSERT INTO problems
        (`title`, `description`, `mml`, `status`, `submitted`, `submitted_by`)
        VALUES('%s', '%s', '%s', 0, NOW(), $this->user_id)",
        mysql_real_escape_string($data['title']),
        mysql_real_escape_string($data['description']),
        mysql_real_escape_string($data['mml']));
    if(!mysql_query($insert)){
        $this->setError(mysql_error().$insert);
        return false;
    }
    return true;
}

/*
Submit a solution to a problem
*/
public function submitSolution($data){
    if(empty($data['problem_id'])){
        $this->setError('Problem ID can not be null.');
        return false;
    }
    $insert = sprintf("INSERT INTO solutions
    (`problem_id`, `solution`, `submitted_by`, `submitted`)
    VALUES('%s', '%s', $this->user_id, NOW())",
    mysql_real_escape_string($data['problem_id']),
    mysql_real_escape_string($data['mml']));
    mysql_query($insert) or $this->setError(mysql_error(). $insert);
    return true;
}

/*
Create a list (of problems)
*/
public function createList($listname){
    $insert = sprintf("INSERT INTO lists
        (`short_name`, `owner`, `created`)
        VALUES('%s', $this->user_id, NOW())",
        mysql_real_escape_string($listname));
    mysql_query($insert) or die(mysql_error().$insert);
    return true;
}

/*
Rename a list
*/
public function renameList($list_id, $listname){
    if(!$this->isListMine($list_id)){
        $this->setError("Not your list.");
        return false;
    }
    $update = sprintf("UPDATE lists SET `short_name` = '%s'
        WHERE id = '%s'",
        mysql_real_escape_string($listname),
        mysql_real_escape_string($list_id));
    mysql_query($update) or die(mysql_error() . $update);
    return true;
}

/*
Delete one's own list
*/
public function deleteList($list_id){
    if(!$this->isListMine($list_id)){
        $this->setError("Not your list.");
        return false;
    }
    $delete = sprintf("DELETE FROM lists 
        WHERE id = '%s' AND `owner` = '$this->user_id'",
        mysql_real_escape_string($list_id));
    mysql_query($delete) or die(mysql_error() . $delete);
    return true;
}
/*
Add a problem to a list
*/
public function addProblemToList($problem_id, $list_id){
    if(!$this->isListMine($list_id)){
        $this->setError('This is not your list.');
        return false;
    }
    // get current list
    $select = sprintf("SELECT problem_ids FROM lists
        WHERE id = '%s'",
        mysql_real_escape_string($list_id));
    $res = mysql_query($select) or die(mysql_error().$select);
    $row = mysql_fetch_assoc($res);
    //append ",$problem_id"
    $new_problem_string = $row['problem_ids'].','.$problem_id;
    //update the table
    $update = sprintf("UPDATE lists SET problem_ids = '%s'
        WHERE id = '%s'",
        mysql_real_escape_string($new_problem_string),
        mysql_real_escape_string($list_id));
    mysql_query($update) or die($update . mysql_error());
    return true;
}
/*
Remove problem from a list
*/
public function removeProblemFromList($problem_id, $list_id){
    if(!$this->isListMine($list_id)){
        $this->setError('This is not your list.');
        return false;
    }
    // get current list
    $select = sprintf("SELECT problem_ids FROM lists
        WHERE id = '%s'",
        mysql_real_escape_string($list_id));
    $res = mysql_query($select) or die(mysql_error().$select);
    $row = mysql_fetch_assoc($res);
    // remove the problem_id with preg_replace?
    // or after creating an array?
    $current_problem_ids = explode(',', $row['problem_ids']);
    $new_problem_ids = array();
    for($i=0;$i<=count($current_problem_ids); $i++){
        if($problem_id == $current_problem_ids[$i]) continue;
        $new_problem_ids[] = $current_problem_ids[$i];
    }
    $new_problem_string = implode(',', $new_problem_ids);
    //update the table
    $update = sprintf("UPDATE lists SET problem_ids = '%s'
        WHERE id = '%s'",
        mysql_real_escape_string($new_problem_string),
        mysql_real_escape_string($list_id));
    mysql_query($update) or die($update . mysql_error());
    return true;
}

/*
Check if the logged in user owns the list
*/
private function isListMine($list_id){
    $select = sprintf("SELECT 1 FROM lists
        WHERE id='%s' AND `owner` = '$this->user_id'",
        mysql_real_escape_string($list_id));
    $res = mysql_query($select) or die(mysql_error().$select);
    if(mysql_num_rows($res) > 0)
        return true;
    return false;
}

/*
Get lists of a user
*/
public function getMyLists(){
    $select = "SELECT * FROM lists 
        WHERE `owner`='$this->user_id'";
    $res = mysql_query($select);
    $lists = array();
    while($row = mysql_fetch_assoc($res)){
        $lists[] = $row;
    }
    return $lists;
}
}//class ends
