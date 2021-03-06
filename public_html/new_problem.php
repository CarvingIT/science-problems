<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
    $data = $_POST;
    $data['mml'] = $data['text_mml'].file_get_contents($_FILES['mml']['tmp_name']);
    $data['figure'] = file_get_contents($_FILES['figure']['tmp_name']);
    $data['mml_file'] = $_FILES['mml']['tmp_name']; 
    $data['figure_file'] = $_FILES['figure']['tmp_name']; 
    if(!$u->submitProblem($data)){
        $error = $u->error;
    }
    else{
        $msg = 'Problem submitted successfully. It will appear on the website after approval of an editor. Thank you for contributing to this growing collection of science-problems!';
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
															<h2>New Problem</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
<form class="fullwidth" enctype="multipart/form-data" method="post" action="">
<p>
If your problem description contains special mathematical signs, upload an MathML file of the problem below.
</p>
<label>Problem description</label>
<textarea name="text_mml">
</textarea>

<label>MathML file. Contents of this MML file will be shown as the problem to users.</label>
<input type="file" class="file" name="mml" />
<hr/>
<h3>Optional fields</h3>
<label>Accompanying figure, if any. Only png and jpg images are supported.</label>
<input type="file" class="file" name="figure" />
<label>Title</label>
<input type="text" name="title" value="" required/>
<label>Description</label>
<input type="text" name="description" value="" />
<label>Keywords</label>
<input type="text" name="keywords" value="" />
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
