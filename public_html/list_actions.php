<?php include 'includes/php_header.php'; 
    if($u->listAction($_POST['p'], $_POST['list_id'])){
        header("location:$_SESSION[current_url]");
    }
    else{
        //following is for debugging
        if($u->app_config['debug'] == 1){
            echo $u->error;
        }
    }
?>

