<?php include 'includes/php_header.php'; 
    $_SESSION['current_list_offset']++;
    $next = $_SESSION['list_problems'][$_SESSION['current_list_offset']];
    header("location:/p/$next");
?>

