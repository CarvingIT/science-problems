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
															<h2>Problem List - <?php echo $_GET['u'].'/'.$_GET['list']."($problem_count)"; ?></h2>
                                                            <?php }else if($_GET['type'] == 'latest'){ ?>
                                                            <h2>Latest submissions</h2>
                                                            <?php } ?>
                  <span class="byline">
                  <?php 
                    if($problem_count > 0){ 
                        if(!empty($_GET['u'])){ 
                  ?>
                  <a href="/set_list.php?list_path=<?php echo $_SERVER['REQUEST_URI']; ?>">Play this list!</a>
                  <?php }} else{ ?>
                    There currently are no problems in this list.
                  <?php } ?>
                  </span>
														</header>
                                                        <ul>
                                                        <?php
                                                        foreach($problems as $p){
                                                            echo "<li><a href=\"/p/$p[id]\" title=\"$p[title]\">$p[title]</a></li>";
                                                        }
                                                        ?>
                                                        </ul>
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
