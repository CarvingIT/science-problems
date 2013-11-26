<?php include 'includes/php_header.php'; ?>
<?php
    if($_GET['type'] == 'latest'){
        $problems = $u->getLatestProblems();
    }
    else if(!empty($_GET['u'])){
        $problems = $u->getProblemsOfUserList($_GET['u'], empty($_GET['list'])?'all':$_GET['list']);
    }
    $problem_count = count($problems);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems - <?php echo $problem['title']; ?></title>
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
												
												<!-- Content -->
													<article class="box is-post">
														<header>
                                                            <?php 
                                                            if(!empty($_GET['u'])){ ?>
															<h2 class="no-print">Problem List - <?php echo $_GET['u'].'/'.$_GET['list']."($problem_count)"; ?></h2>
                                                            <h2 class="print"><?php echo $_GET['list']; ?></h2>
                                                            <?php }else if($_GET['type'] == 'latest'){ ?>
                                                            <h2>Latest submissions</h2>
                                                            <?php } ?>
                  <span class="byline">
                  <?php 
                    if($problem_count > 0){ 
                        if(!empty($_GET['u'])){ 
                  ?>
                  <a class="no-print" href="/set_list.php?list_path=<?php echo $_SERVER['REQUEST_URI']; ?>" title="Play this list"><img src="/images/play.png"/></a>
                  <?php }} else{ ?>
                    There currently are no problems in this list.
                  <?php } ?>
                  </span>
														</header>
                                                        <?php
                                                        foreach($problems as $p){
                                                            echo "$p[mml]<br/><a class=\"no-print\" title=\"Solution\" href=\"/p/$p[id]\" title=\"$p[title]\"><img src=\"/images/lit_bulb.png\"/></a>";
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
