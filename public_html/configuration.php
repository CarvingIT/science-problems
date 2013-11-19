<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
    $u->updateConfig($_POST);
}
$config = getConfig();
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
															<h2>Configuration</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
														</p>
                                   <form class="fullwidth" method="post">
                                   <?php
                                    foreach($config as $c=>$v){
                                        echo "
                                            <label>$c</label>
                                            <input type=\"text\" name=\"$c\" value=\"$v\"/>";
                                    }
                                   ?>
                                   <input type="submit" name="action" value="Save Configuration"/>
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
