<?php include 'includes/php_header.php'; ?>
<?php
    if(!empty($_GET['u'])){
        $problems = $u->getProblemsOfUserList($_GET['u'], empty($_GET['list'])?'all':$_GET['list']);
    }
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
															<h2>Problem List - <?php echo $_GET['u'].'/'.$_GET['list']; ?></h2>
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
