<?php include 'includes/php_header.php'; ?>
<?php
$problem = $u->getRandomProblem();
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
 <a href="/p/<?php echo $problem['id']; ?>"><img src="/images/solutions.png" title="See the solution"></a> 
 <a href="/?r=<?php echo rand(); ?>"><img src="/images/next.png" title="Next random problem"></a> 
															<span class="byline"><?php echo $problem['title']; ?></span>
														</header>
<p>
<?php echo $problem['mml']; ?>
</p>
<p>
 <a href="/p/<?php echo $problem['id']; ?>"><img src="/images/solutions.png" title="See the solution"></a> 
 <a href="/?r=<?php echo rand(); ?>"><img src="/images/next.png" title="Next random problem"></a> 
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
