<?php
error_reporting(0);
include 'db_connect.php';
//session_set_cookie_params('300');
//session_regenerate_id(true);

function getConfig(){
	$select = "SELECT * FROM config";
	$res = mysql_query($select) or die($select . mysql_error());
	$app_config = array();
	while($row = mysql_fetch_assoc($res)){
		$app_config[$row['param']] = $row['value'];
	}
	return $app_config;
}

function getUserTypeIdfromType($userType){
#### returns all the info stored in params table
	$select = sprintf("SELECT id FROM user_types WHERE type='%s'",
                mysql_real_escape_string($userType));
	$res = mysql_query($select) or die($select . mysql_error());
	list($user_type_id)=mysql_fetch_row($res);
	return $user_type_id;
}

function generatePassword() {
	$chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    while ($i <= 7) {
        $num = rand() % 61;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    return $pass;
}

function getEmailTemplateBody($template_file_path){
	$content = file_get_contents($template_file_path);
	return $content;
}

function getEmailBody($template_body,$arr_of_variable){
$body = $template_body;
$app_config = getConfig();

foreach($arr_of_variable as $k => $v){
//      $pattern="/\[\[$k\]\]/";
//      $v = str_replace('$', '\$', $v);
        $pattern[$k]="/\[\[$k\]\]/";
        $replacement[$k] = str_replace('$', '\$', $v);
//      $body = preg_replace($pattern,$v,$body);
        $body = preg_replace($pattern,$replacement,$body);
}
$pattern= '/\[\[server\]\]/';
$body = preg_replace($pattern,$app_config['http_host'],$body);
return $body;
}
 
function sanitizeInput($s){
	//return mysql_real_escape_string($s);
	return htmlentities($s, ENT_QUOTES, 'UTF-8',false);
}

function sendTemplateEmail($to,$subject_path,$body_path,$template_vars){
$app_config = getConfig();
$email_from_address='no-reply@aad.org';	
include 'config.php';
$subject_path = $app_config['document_root']."/".$subject_path;
$body_path = $app_config['document_root']."/".$body_path;
//$headers = "From:$email_from_address\n";
$headers = "From:$email_from_address\n";
$email_subject_body = getEmailTemplateBody($subject_path);
$email_template_body = getEmailTemplateBody($body_path);
$email_body = getEmailBody($email_template_body,$template_vars);
$email_subject = getEmailBody($email_subject_body,$template_vars);
mail($to, $email_subject, $email_body, $headers);
}        

function logMessage($msg){
$app_config = getConfig();
$logfile = $app_config['document_root'].'/../logs/log.txt';
$fd = fopen($logfile,"a");
fwrite($fd, date('c').' | '.$msg.PHP_EOL);
fclose($fd);
}

function isCurrent($uri){
    if($_SERVER['REQUEST_URI'] == $uri){
        return true;
    }
    return false;
}

function current_page_url(){
    $page_url   = 'http';
    if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on'){
        $page_url .= 's';
    }
    return $page_url.'://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
}

// calls to initialization functions
$app_config = getConfig();
#date_default_timezone_set('America/New_York');
?>
