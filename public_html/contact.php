<?php include 'includes/php_header.php'; ?>
<?php
if($_POST){
    if($u->contactWebmaster($_POST)){
        $msg = "Thank you for contacting us. We shall get in touch with you soon.";
    }
    else{
        $error = $u->error;
    }
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems - Contact</title>
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
															<h2>Contact</h2>
															<span class="byline">Fill out the form below to get in touch with us.</span>
														</header>
<span class="message"><?php echo $msg; ?></span>
<span class="error"><<?php echo $error; ?>/span>
<form class="fullwidth" method="post" action="">
<label>Your name</label>
<input type="text" name="name" value="" required/>
<label>Your Email</label>
<input type="text" name="email" value="" required/>
<label>Subject</label>
<input type="text" name="subject" value="" required/>
<label>Message</label>
<textarea name="message" required/>
</textarea>
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
