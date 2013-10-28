<?php
session_start();
$_SESSION['user_id'] = null;
//redirect to the home page
header("location:/");
?>
