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

}//class ends

