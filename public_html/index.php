<?php include 'includes/php_header.php'; ?>
<?php
$problem = $u->getRandomProblem();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!-- link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,900,300italic" rel="stylesheet" /--> 
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.js"></script>
		<script src="js/config.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-panels.min.js"></script>

        <script type="text/x-mathjax-config">
        MathJax.Hub.Config({
        MathML: {
              extensions: ["content-mathml.js"]
                }
                });
        </script>
		<script type="text/javascript" src="/js/mathjax/MathJax.js?config=MML_HTMLorMML-full"></script>

		<noscript>
			<link rel="stylesheet" href="css/skel-noscript.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><link rel="stylesheet" href="css/ie8.css" /><![endif]-->
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
															<span class="byline"><?php echo $problem['title']; ?></span>
														</header>
<p>
<?php echo $problem['mml']; ?>
</p>
<p>
                                                        <a href="/problem.php?p=<?php echo $problem['id']; ?>">See the solution</a> |
                                                        <a href="#">Next random problem</a> |
                                                        <a href="#">Next problem in my list</a>
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
