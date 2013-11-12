<?php include 'includes/php_header.php'; ?>
<?php
if($_POST){
    if($u->updateUser($_POST)){
        $msg = "The updates have been done successfully.";
    }
    else{
        $err = $u->error;
    }
}
$user = $u->getUserDetails($_GET['id']);
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
															<h2>Update User</h2>
														</header>
<?php
    if(!empty($err)){
        echo "<span class=\"error\">$err</span>";
    }
    if(!empty($msg)){
        echo "<span class=\"message\">$msg</span>";
    }
?>
<form class="fullwidth" method="post" action="">
<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
<label><?php echo $user['username']; ?></label><br/>
<label><?php echo $user['email']; ?></label><br/>
<label>Your name</label>
<input type="text" name="full_name" value="<?php echo $user['name']; ?>" required/>
<label>Password</label>
<input type="password" name="password" value="" />
<label>Password again</label>
<input type="password" name="password_again" value="" />
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
