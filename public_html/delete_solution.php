<?php
include 'includes/php_header.php';
$u->deleteSolution($_GET['s']);
header("location:".$_SERVER['HTTP_REFERER']);
