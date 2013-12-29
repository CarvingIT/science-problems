<?php include 'includes/php_header.php'; ?>
<?php
    $offset = $_GET['p']*10;
    $limit = 10;
    $problems = $u->searchProblems($_GET['keywords'], $offset, $limit);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems - Search</title>
    <?php include 'includes/html_head_include.php'; ?>
	</head>
	<body class="no-sidebar">
<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
		
		<!-- Main Wrapper -->
			<div id="main-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
							
							<!-- Portfolio -->
								<section>
									<div>
										<div class="row">
											<div class="12u skel-cell-mainContent">
                <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/searchbox.php'; ?>
												
												<!-- Content -->
													<article class="box is-post">
                  <?php 
                    if(count($problems) == 0){
                        echo "Your search returned no results.";
                    }
                  ?>
                                                        <?php
                                                        foreach($problems as $p){
                                                            if(!empty($p['path'])){
                                                                echo "$p[mml]<br/><a class=\"no-print\" title=\"Solution\" href=\"/problem/$p[path]\" title=\"$p[title]\"><img src=\"/images/lit_bulb.png\"/></a>";
                                                            }
                                                            else{
                                                                echo "$p[mml]<br/><a class=\"no-print\" title=\"Solution\" href=\"/p/$p[id]\" title=\"$p[title]\"><img src=\"/images/lit_bulb.png\"/></a>";
                                                            }
                                                            $figures = $u->getFiguresOfProblem($p['id']);
                                                            foreach($figures as $f){
                                                                echo "<img class=\"figure\" src=\"/figure.php?fig=$f\"/><br/>";
                                                            }
                                                            echo "<hr/>";
                                                        }
                                                        ?>
														</section>
													</article>

											</div>
										</div>
									</div>
								</section>

						</div>
					</div>
				</div>
			</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>
	</body>
</html>
