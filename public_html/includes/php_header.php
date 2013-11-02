<?php
session_start();
include '../lib/User.class.php';
$u = new User($_SESSION['user_id']);

if($u->isAdmin()){
include '../lib/Admin.class.php';
    $u = new Admin($_SESSION['user_id']);
}
else if($u->isAuthUser()){
    include '../lib/AuthUser.class.php';
    $u = new AuthUser($_SESSION['user_id']);
}

?>
