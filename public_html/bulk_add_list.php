<?php include 'includes/php_header.php'; 
    if($_POST['new_old'] == 'new'){
        /*
        Create a new list
        And then add problems to the list
        */
        $u->createList($_POST['new_list_name']);
        //Get the id of the list
        $list_id = $u->getUserListId($u->user_profile['username'], $_POST['new_list_name']);

        foreach($_POST['problem_id'] as $p_id){
            $u->listAction($p_id, $list_id);
        }
    }
    else if($_POST['new_old'] == 'old'){
        /* 
        Get the list id
        Add problems to it
        */
        foreach($_POST['problem_id'] as $p_id){
            $u->listAction($p_id, $_POST['list']);
        }
    }
    // Finally, redirect user to the lists page
    header("location:/my_lists.php");
?>
