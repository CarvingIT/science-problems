<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
}
$problems = $u->getProblemsAwaitingApproval();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Problems awaiting approval</title>
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
															<h2>Problems needing approval</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
														</p>
                     <ul>
                     <?php 
                        foreach($problems as $p){
                            echo "<li><a href=\"/p/$p[id]\">$p[title]</a></li>";
                        }
                        if(count($problems == 0)){
                            echo "There are no submissions that are awaiting approval.";
                        }
                     ?>
                     </ul>
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
