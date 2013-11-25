<?php include 'includes/php_header.php'; 
    $figure_data = $u->getFigure($_GET['fig']);
    header("Content-type:$figure_data[filetype]");
    echo $figure_data['figure'];
?>

