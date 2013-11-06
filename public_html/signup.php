<?php include 'includes/php_header.php'; ?>
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
															<h2>Sign up!</h2>
															<span class="byline">Signing up is necessary if you want to contribute problems and/or solutions.</span>
														</header>
<form class="fullwidth" method="post" action="">
<label>Choose a username</label>
<input type="text" name="username" value="" required/>
<label>Enter your email address</label>
<input type="text" name="email" value="" required/>
<label>Your name</label>
<input type="text" name="full_name" value="" required/>
<label>Password</label>
<input type="password" name="password" value="" required/>
<label>Password again</label>
<input type="password" name="password_again" value="" required/>
<br/>
<input type="submit"/>
</form>
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
