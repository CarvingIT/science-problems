<?php
include_once('AuthUser.class.php');

class Admin extends AuthUser{

public function __construct($user_id){
    parent::__construct($user_id);
    if(!$this->isAdmin()){
        $this->_loginRedirect();
        throw new Exception('No privileges');
    }
}

/*
Get list of problems for approval
*/
public function getProblemsAwaitingApproval(){
    $select = "SELECT * FROM problems 
        WHERE status IS NULL OR status = 0";
    $res = mysql_query($select) or $this->setError(mysql_error().$select);
    $problems = array();
    while($row = mysql_fetch_assoc($res)){
        $problems[] = $row;
    }
    return $problems;
}

/* 
Get a problem by id
Overridden function for admin!
*/
public function getProblemById($problem_id){
    $select = sprintf("SELECT * FROM problems 
        WHERE id = '%s'",
        mysql_real_escape_string($problem_id));
    $res = mysql_query($select);
    return mysql_fetch_assoc($res);
}

/*
Approve a problem. Sets status to 1
*/
public function approveProblem($problem_id){
    $update = sprintf("UPDATE problems
        SET status = 1 WHERE id = '%s'",
        mysql_real_escape_string($problem_id));
    mysql_query($update) or $this->setError(mysql_error().$update);
    return true;
}
/*
Approve a solution. Sets status to 1
*/
public function approveSolution($solution_id){
    $update = sprintf("UPDATE solutions
        SET status = 1 WHERE id = '%s'",
        mysql_real_escape_string($solution_id));
    mysql_query($update) or $this->setError(mysql_error().$update);
    return true;
}

/* 
Delete a solution
*/

public function deleteSolution($solution_id){
    $delete = sprintf("DELETE FROM solutions 
        WHERE id = '%s'",
        mysql_real_escape_string($solution_id));
    $res = mysql_query($delete) or die(mysql_error().$delete);
    return true;
}

/*
Delete a problem
*/
public function deleteProblem($problem_id){
    //first delete all solutions of the problem
    $delete = sprintf("DELETE FROM solutions 
        WHERE problem_id = '%s'",
        mysql_real_escape_string($problem_id));
    mysql_query($delete) or $this->setError(mysql_error().$delete);
    //then delete the problem
    $delete = sprintf("DELETE FROM problems
        WHERE id = '%s'",
        mysql_real_escape_string($problem_id));
    mysql_query($delete) or $this->setError(mysql_error().$delete);

    //delete figures 
    $this->deleteFiguresOfProblem($problem_id);
    return true;
}

/* 
Delete figures of problem
*/
public function deleteFiguresOfProblem($problem_id){
    $delete = sprintf("DELETE FROM figures 
        WHERE problem_id = '%s'",
        mysql_real_escape_string($problem_id));
    $res = mysql_query($delete) or die(mysql_error() . $delete);
    return true;
}

/*
Get a list of users
*/
public function getUsers($criteria){
    //$criteria is an array
    if(empty($criteria['limit'])){
        $criteria['limit'] = 50;
    }
    if(empty($criteria['offset'])){
        $offset = 0;
    }

    $select = "SELECT * FROM users 
        WHERE 1 ";
    $select .= " LIMIT $offset, $criteria[limit]";
    $res = mysql_query($select) or die(mysql_error().$select);
    $users = array();
    while($row = mysql_fetch_assoc($res)){
        $users[] = $row;
    }
    return $users;
}

/*
Update User details
*/
public function updateUser($data){
    if(empty($data['password'])){
    $update = sprintf("UPDATE users
        SET `name` = '%s'
        WHERE id = '%s'",
        mysql_real_escape_string($data['full_name']),
        mysql_real_escape_string($data['id']));
    }
    else{
        if($data['password'] != $data['password_again']){
            $this->setError("Passwords don't match.");
            return false;
        }
        $update = sprintf("UPDATE users
            SET `name` = '%s', `password` = '%s'
            WHERE id = '%s'",
            mysql_real_escape_string($data['full_name']),
            MD5($data['password']),
            mysql_real_escape_string($data['id']));
    }
    $res = mysql_query($update) or die(mysql_error().$update);
    return true;
}

/*
    Function to update the configuration of the application
*/
public function updateConfig($data){
    $config = array();
    foreach($data as $c=>$v){
        $update = sprintf("UPDATE config SET `value` = '%s'
                WHERE `param` = '%s'",
                mysql_real_escape_string($v),
                mysql_real_escape_string($c));
        mysql_query($update) or die(mysql_error() . $update);
    }
    return true;
}
}//class ends
