<?php
include 'includes/php_header.php';
$u->approveSolution($_GET['s']);
header("location:/awaiting_problems.php");
