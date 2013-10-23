<?php
include_once 'lib.php';
include_once "db_connect.php";
include_once "class.phpmailer.php";

class User{
	//class variables
	var $user_id = null;
	var $user_type = null;
	var $remote_ip = null;
	var $error = null;
	var $error_code = null;
	var $user_profile = null;
	var $app_config = null;

    public function __construct($user_id=null){
        $this->user_id = $user_id;
		if(!empty($user_id)){
			$this->user_type = $this->getUserType();
			$this->user_profile = $this->getUserDetails($user_id);
		}
		//some initialization stuff here
		$this->app_config = getConfig();
    }

	function __call($functionName, $argumentsArray ){
		$this->setError('undefined_function');
	}

/*
function setError() 
	assign error to the class variable $error.
*/
public function setError($error){
    $this->error = $error;
}
/* 
	The following function sets the error_code
*/
public function setErrorCode($error_code){
	$this->error_code = $error_code;
}

/*
function hasError() 
	return true if class varible has some error value else return false. 
*/
public function hasError(){
	if(empty($this->error)){
		return false;
	}
	return true;
}
/*
function authenticate($username,$password); 
	validate user entered username and password with database username and password 
	if it matches return user_id, user_type and set user_id in session
	other wise it return false with error message.
*/
public function authenticate($username, $password){
    $select = sprintf("SELECT id FROM users 
        WHERE username = '%s' AND password = '%s' AND status = 1",
                
        mysql_real_escape_string($username),
        md5($password));
    $res = mysql_query($select);
    if(!$res){
        $this->setError("auth_failure");
        return false;
    }
	if(mysql_num_rows($res) > 0){
        $res_ar = mysql_fetch_assoc($res);
        // set user id of the logged in user    
        $this->user_id = $res_ar['id'];
		$this->user_type = $this->getUserType();
		$this->_setUserProfile();
        return true;
    }
    else{
        $this->setError("auth_failure");
        return false;
    }
}

/* function logout
	added for activity logging purpose
*/
public function logout(){
		//remove user_id from the session
		$_SESSION['user_id'] = null;
}

private function _setUserProfile(){
	$this->user_profile = $this->getUserDetails($this->user_id);
}

/*
function isAdmin() 
	return true if logged in user type is Admin other wise return false with error message.
*/
public function isAdmin(){
	$select = "SELECT 1 FROM users 
		LEFT JOIN user_types ON users.type = user_types.id
		WHERE users.id = $this->user_id 
		AND user_types.type = 'Admin'";
	$res = mysql_query($select) or $this->setError('You are not the Admin');
	if(mysql_num_rows($res) == 1){
		return true;
	}
	return false;
}

/*
function getUserType() 
	return user type of logged in user.
*/
private function getUserType(){
		$select = "SELECT user_types.type FROM user_types 
			LEFT JOIN users ON user_types.id = users.type
			WHERE users.id = $this->user_id";
		$res = mysql_query($select);
		$row = mysql_fetch_assoc($res);
		return $row['type'];
}

/*
function _loginRedirect() 
	function redirect user to the index page. 
*/
public function _loginRedirect(){
       	// send user to the login page
       	header("Location:/index.php");
}
    
/*
function reset_password($username,$pwd,$userEmail)
	function accept three parameters username password and email address
	and reset the user password and return true after successfully password reset other wise retun false 
	with error message.
*/
public function resetPassword($userName,$pwd,$userEmail){
	$select = sprintf("SELECT * FROM users WHERE username = '%s' AND email = '%s'",
		mysql_real_escape_string($userName),
                mysql_real_escape_string($userEmail));
		$result = mysql_query($select);
		if(mysql_num_rows($result) != 0){
			
		   $update=sprintf("UPDATE users SET `password`='%s' WHERE username='%s' AND email = '%s'",
	                   mysql_real_escape_string(md5($pwd)),
        	           mysql_real_escape_string($userName),
                	   mysql_real_escape_string($userEmail)
			);
        	        if(mysql_query($update)){
                	        return true;
	                }else{
        	                $this->setError($update.mysql_error());
                	         return false;
	                }
		 }# if of not empty array check
	         else{
        	       $this->setError("reset_password_error");
                       return false;
	        }
}
/*
function change_password($data)
	function accept data array as parameter and change the password in users table for the user id in the parameter array.
*/
public function changePassword($data){
    if($this->authenticateMD5($data['userName'],$data['oldpwd'])){
        if($data['newpwd']==$data['newpwdagn']){

		// check if the password is strong
		if(!$this->isPasswordStrong($data['newpwd'])){
			$this->setError('weak_password');
			return false;
		}

        $update=sprintf("UPDATE users SET `password`='%s' WHERE id=%s",
                mysql_real_escape_string(md5($data['newpwd'])),
                mysql_real_escape_string($this->user_id));
            if(mysql_query($update)){
                    return true;
            }else{
               $this->setError($update.mysql_error());
               return false;
            }
            }else{
                //$this->setError($update.mysql_error());
                $this->setError("New Password and Retype Password does not match.");
                return false;
        }
    }
}

public function submitProblem($data){

}

}//User class ends here
?>
