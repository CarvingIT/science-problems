<?php
session_start();
include '../lib/User.class.php';
$u = new User($_SESSION['user_id']);
?>
