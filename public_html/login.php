<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
   if($u->authenticate($_POST['username'], $_POST['password'])){
        $_SESSION['user_id'] = $u->user_id;
        //redirect to the site home
        header("location:/");
   }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Login</title>
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
															<h2>Login</h2>
														</header>
														<p>
<span class="error"><?php echo $u->error; ?></span>
<form class="fullwidth" method="post" action="">
<label>Your username</label>
<input type="text" name="username" value="" required/>
<label>Password</label>
<input type="password" name="password" value="" required/>
<br/>
<input type="submit"/>
</form>
														</p>
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
