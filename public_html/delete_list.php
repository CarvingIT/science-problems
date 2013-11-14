<?php
include 'includes/php_header.php';
$u->deleteList($_GET['id']);
if(!empty($u->error)){
    echo $u->error;
    exit;
}
header("location:/my_lists.php");
