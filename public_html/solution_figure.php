<?php include 'includes/php_header.php'; 
    $figure_data = $u->getSolutionFigure($_GET['sol']);
    header("Content-type:$figure_data[filetype]");
    echo $figure_data['figure'];
?>

