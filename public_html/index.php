<?php include 'includes/php_header.php'; ?>
<?php
$problem = $u->getRandomProblem();
$figures = $u->getFiguresOfProblem($problem['id']);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems</title>
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
															<h2>Random problem</h2>
 <span class="no-print">
 <?php if(!empty($problem['path'])){ ?>
 <a href="/problem/<?php echo $problem['path']; ?>"><img src="/images/lit_bulb.png" title="See the solution"></a> 
 <?php }else{ ?>
 <a href="/p/<?php echo $problem['id']; ?>"><img src="/images/lit_bulb.png" title="See the solution"></a> 
 <?php } ?>
 <a href="/?r=<?php echo rand(); ?>"><img src="/images/reload.png" title="Next random problem"></a> 
 </span>
															<span class="byline"><?php echo $problem['title']; ?></span>
														</header>
<p>
<?php echo $problem['mml']; ?>
</p>
                                                        <p>
                                                        <?php
                                                            foreach($figures as $f){
                                                            echo "<img src=\"/figure.php?fig=$f\"/><br/>";
                                                            }
                                                        ?>
                                                        </p>
<p>
 <span class="no-print">
 <?php if(!empty($problem['path'])){ ?>
 <a href="/problem/<?php echo $problem['path']; ?>"><img src="/images/lit_bulb.png" title="See the solution"></a> 
 <?php }else{ ?>
 <a href="/p/<?php echo $problem['id']; ?>"><img src="/images/lit_bulb.png" title="See the solution"></a> 
 <?php } ?>
 <a href="/?r=<?php echo rand(); ?>"><img src="/images/reload.png" title="Next random problem"></a> 
 </span>
</p>
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
