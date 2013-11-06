<?php include 'includes/php_header.php'; 
    if(!empty($_GET['list_path'])){
        preg_match('#l/u-([^/]+)/([^/]+)#', $_GET['list_path'], $matches);
        $problems = $u->getProblemsOfUserList($matches[1], $matches[2]);
    }
    $list_problems = array();
    foreach($problems as $p){
        $list_problems[] = $p['id'];
    }
    $_SESSION['list_problems'] = $list_problems;
    $_SESSION['current_list_offset'] = 0;
    header("location:/p/$list_problems[0]");
?>

