<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';
    $problem = $u->getProblemById($_GET['p']);
    $figures = $u->getFiguresOfProblem($_GET['p']);

if($_POST){
    $data = $_POST;
    $data['mml'] = file_get_contents($_FILES['mml']['tmp_name']);
    $data['figure'] = file_get_contents($_FILES['figure']['tmp_name']);
    if(!$u->editProblem($data)){
        $error = $u->error;
    }
    else{
        $msg = 'Problem updated successfully. It will appear on the website after approval of an editor. Thank you for contributing to this growing collection of science-problems!';
    }
}
    $problem = $u->getProblemById($_GET['p']);

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
															<h2>Edit Problem</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
<?php echo $problem['mml']; ?>
<form class="fullwidth" enctype="multipart/form-data" method="post" action="">
<input type="hidden" name="problem_id" value="<?php echo $_GET['p']; ?>"/>
<label>Title</label>
<input type="text" name="title" value="<?php echo $problem['title']; ?>" required/>
<label>Keywords/Description</label>
<input type="text" name="description" value="<?php echo $problem['description']; ?>" required/>
<?php if($u->isAdmin()){ ?> 
<label>Path</label>
<input type="text" name="path" value="<?php echo $problem['path']; ?>" />
<label>MathML file. Leave blank if there's no change.</label>
<?php } ?>
<input type="file" name="mml" />
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
