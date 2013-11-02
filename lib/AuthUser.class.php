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

}//class ends

