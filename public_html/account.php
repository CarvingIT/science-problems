<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
    //update account
    if($u->updateAccount($_POST)){
        $msg = "Account information updated successfully.";
    }
    else{
        $error = $u->error;
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
															<h2>My Account</h2>
														</header>
														<p>
<span class="error"><?php echo $u->error; ?></span>
<span class="message"><?php echo $msg; ?></span>
<form class="fullwidth" method="post" action="">
<label>Username: <?php echo $u->user_profile['username']; ?></label><br/>
<label>Email: <?php echo $u->user_profile['email']; ?></label><br/>
<label>Name</label>
<input type="text" name="full_name" value="<?php echo $u->user_profile['name']; ?>"/>
<label>Password</label>
<input type="password" name="password" value=""/>
<label>Password again</label>
<input type="password" name="password_again" value=""/>
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
