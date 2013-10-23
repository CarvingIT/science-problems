<?php
	$db = 'science_problems';
	$db_host = 'localhost';
	$db_user = 'science_problems';
	$db_pass = 'science_problems123';
	$dbh = mysql_connect($db_host, $db_user, $db_pass) or die(mysql_error());
	mysql_select_db($db, $dbh);
?>
