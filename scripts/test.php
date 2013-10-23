<?php
include '../lib/User.class.php';

$u = new User();
if($u->authenticate('admin', 'adminketan404')){
    echo "success";
}
else{
    echo "failure";
}
