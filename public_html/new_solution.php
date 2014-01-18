<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

$problem = $u->getProblemById($_GET['p']);

if($_POST){
    $data = $_POST;
    $data['figure'] = file_get_contents($_FILES['figure']['tmp_name']);
    $data['figure_file'] = $_FILES['figure']['tmp_name']; 
    $data['mml'] = file_get_contents($_FILES['mml']['tmp_name']);
    if(!$u->submitSolution($data)){
        $error = $u->error;
    }
    else{
        $msg = 'Solution submitted successfully. It will appear on the website after approval of an editor. Thank you for contributing to this growing collection of science-problems!';
    }
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>New problem</title>
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
															<h2>New Solution</h2>
														</header>
														<p>
<h3>Problem</h3>
<?php
echo $problem['mml'];
?>
<h3>Upload solution file</h3>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
<form class="fullwidth" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="problem_id" value="<?php echo $_GET['p']; ?>"/>
<label>Figure (optional)</label>
<input type="file" class="file" name="figure" />
<label>MathML file</label>
<input type="file" class="file" name="mml" required/>
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
