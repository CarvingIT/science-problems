<?php include 'includes/php_header.php'; 
    $u->listAction($_POST['p'], $_POST['list_id']);
    header("location:$_SERVER[HTTP_REFERER]");
?>

