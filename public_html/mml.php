<?php include 'includes/php_header.php'; 
    if($_GET['type'] == 'p'){
    $problem = $u->getProblemById($_GET['p']);
    header("Content-type:text/plain");
    echo $problem['mml'];
    }
    else if($_GET['type'] == 's'){
        $solutions = $u->getSolutions($_GET['p']);
        $n = empty($_GET['n'])?1:$_GET['n'];
     $i = 1;
     foreach($solutions as $s){
         if($n == $i){
         header("Content-type:text/plain");
         echo  $s['solution'];
         exit;
         }
         $i++;
     }
    }
