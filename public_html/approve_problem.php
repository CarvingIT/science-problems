<?php
include 'includes/php_header.php';
$u->approveProblem($_GET['p']);
header("location:/awaiting_problems.php");
