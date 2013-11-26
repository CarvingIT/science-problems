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
			$this->_setUserProfile();
		}
		//some initialization stuff here
		$this->app_config = getConfig();
    }

	function __call($functionName, $argumentsArray ){
		$this->setError('undefined_function ' . $functionName);
	}

/*
function setError() 
	assign error to the class variable $error.
*/
public function setError($error){
    $this->error = $error;
}

/* 
    function that creates a new user
*/
public function registerUser($data){
    if($data['password'] != $data['password_again']){
        $this->setError('Passwords do not match.');
        return false;
    }
    $insert = sprintf("INSERT INTO users
        (`username`, `email`, `password`, `status`, `name`)
        VALUES('%s', '%s', '%s', 1, '%s')",
        mysql_real_escape_string($data['username']),
        mysql_real_escape_string($data['email']),
        MD5($data['password']),
        mysql_real_escape_string($data['full_name']));
    $res = mysql_query($insert) or die(mysql_error().$insert);
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
        $this->setError("Authentication failure. Please try again.");
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

/* functions to check user types 
Redundant functions for public properties
*/
public function isAdmin(){
    if($this->user_type == 'Admin'){
        return true;
    }
    return false;
}

public function isAuthUser(){
    if(!empty($this->user_id)){
        return true;
    }
    return false;
}

/* set user's profile */
private function _setUserProfile(){
    if(empty($this->user_id)){
        return null;
    }
    $select = "SELECT * FROM users
        WHERE id = $this->user_id";
    $res = mysql_query($select);
    $this->user_profile = mysql_fetch_assoc($res);
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

/* 
Get a problem by id
*/
public function getProblemById($problem_id){
    $select = sprintf("SELECT * FROM problems 
        WHERE id = '%s'
        AND (`status` = 1 OR `submitted_by` = '$this->user_id')",
        mysql_real_escape_string($problem_id));
    $res = mysql_query($select) or die(mysql_error().$select);
    return mysql_fetch_assoc($res);
}

/* 
Get a random problem for the home page
*/
public function getRandomProblem(){
    if(!empty($this->app_config['random_list_id'])){
        return $this->getRandomProblemFromRandomList();
    }
    $select = "SELECT * FROM problems 
        WHERE status = 1 
        ORDER BY rand() LIMIT 1";
    $res = mysql_query($select);
    return mysql_fetch_assoc($res);
}

/*
Get a random problem from the list defined in the config
*/
private function getRandomProblemFromRandomList(){
    $problems = $this->getProblemsOfList($this->app_config['random_list_id']); 
    $random = array_rand($problems, 1); 
    return $this->getProblemById($problems[$random]['id']);
}

/* 
Get all approved solutions of a problem
*/
public function getSolutions($problem_id){
    $select = sprintf("SELECT * FROM solutions 
        WHERE problem_id = '%s' 
        AND (`status` = 1 OR `submitted_by`='$this->user_id')",
        mysql_real_escape_string($problem_id));
    $res = mysql_query($select) or $this->setError(mysql_error() . $select);
    $solutions = array();
    while($row = mysql_fetch_assoc($res)){
        $solutions[] = $row;
    }
    return $solutions;
}

/*
Get user details
*/

public function getUserDetails($user_id){
    $select = sprintf("SELECT * FROM users 
        WHERE id = '%s'",
        mysql_real_escape_string($user_id));
    $res = mysql_query($select) or $this->setError(mysql_error() . $select);
    return mysql_fetch_assoc($res);
}

/*
Getting problems from a list created by user
The list will have a unique URL
*/
public function getProblemsOfUserList($username, $listname){
    //first, find the list id
    if($listname == 'all'){
        return $this->getProblemsSubmittedByUser($username);
    }
    else{
        return $this->getProblemsOfList($this->getUserListId($username, $listname)); 
    }
}

/*
Get list_id from username and listname
*/
public function getUserListId($username, $listname){
    $select = sprintf("SELECT lists.id FROM lists
        LEFT JOIN users ON lists.owner = users.id
        WHERE `short_name` = '%s' 
        AND users.username = '%s'",
        mysql_real_escape_string($listname),
        mysql_real_escape_string($username));
    $res = mysql_query($select) or die(mysql_error().$select);
    $row = mysql_fetch_assoc($res);
    return $row['id'];
}

/*
Get problems from a list id
*/
public function getProblemsOfList($list_id){
    $select = sprintf("SELECT problem_ids FROM lists
        WHERE id = '%s'",
        mysql_real_escape_string($list_id));
    $res = mysql_query($select) or die(mysql_error().$select);
    $row = mysql_fetch_assoc($res);
    if(!empty($row['problem_ids'])){
        #$current_problem_ids = explode(',', $row['problem_ids']);
        $select = "SELECT id, title, mml FROM problems
            WHERE id IN ($row[problem_ids])";
        $res = mysql_query($select) or die(mysql_error() . $select);
        $problems = array();
        while($row = mysql_fetch_assoc($res)){
            $problems[] = $row;
        }
    }
    return $problems;
}

/*
Get all problems submitted by a user
*/
public function getProblemsSubmittedByUser($username){
    $select = sprintf("SELECT problems.* FROM problems
        LEFT JOIN users ON problems.submitted_by = users.id
        WHERE users.username = '%s'
        AND (problems.status = 1 OR problems.submitted_by = '$this->user_id')
        ORDER BY submitted DESC",
        mysql_real_escape_string($username));
    $res = mysql_query($select) or die(mysql_error().$select);
    $problems = array();
    while($row = mysql_fetch_assoc($res)){
        $problems[] = $row;
    }
    return $problems;
}

/* 
Latest submissions
*/
public function getLatestProblems(){
    $select = "SELECT * FROM problems
        ORDER BY submitted DESC 
        LIMIT 15";
    $res = mysql_query($select) or die(mysql_error() . $select);
    $problems = array();
    while($row = mysql_fetch_assoc($res)){
        $problems[] = $row;
    }
    return $problems;
}

/*
    function to send email to the webmaster of the site
*/
public function contactWebmaster($data){
    $body = '';
    foreach($data as $k=>$v){
        $body .= "$k: $v\n";
    }
    $subject = $app_config['site_name'].": $data[subject]";
    mail($app_config['webmaster_email_address'], $subject, $body);
}
/*
*/
public function getFiguresOfProblem($problem_id){
    $select = sprintf("SELECT * FROM figures 
        WHERE problem_id = '%s'
        ORDER BY id, display_order",
        mysql_real_escape_string($problem_id));
    $res = mysql_query($select) or die($select . mysql_error());
    $figures = array();
    while($row = mysql_fetch_assoc($res)){
        $figures[] = $row['id'];
    }
    return $figures;
}
/*
Show an image
*/
public function getFigure($fig_id){
    $select = sprintf("SELECT `filetype`, `figure` FROM figures 
        WHERE `id` = '%s'",
        mysql_real_escape_string($fig_id));
    $res = mysql_query($select) or die(mysql_error() . $select);
    return mysql_fetch_assoc($res);
}

}//User class ends here
?>
