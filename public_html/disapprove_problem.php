<?php
include 'includes/php_header.php';
$u->disapproveProblem($_GET['p']);
header("location:".$_SERVER['HTTP_REFERER']);
