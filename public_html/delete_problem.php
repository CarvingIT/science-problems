<?php
include 'includes/php_header.php';
$u->deleteProblem($_GET['p']);
header("location:/awaiting_problems.php");
