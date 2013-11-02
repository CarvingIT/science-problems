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

}//class ends

