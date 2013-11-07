<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST){
    $u->createList($_POST['title']);
}
$my_lists = $u->getMyLists();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>My Lists</title>
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
															<h2>My Lists</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
<form class="fullwidth" method="post" action="">
<label>Title</label>
<input type="text" name="title" value="" required/>
<input type="submit" value="Create a new list"/>
</form>
														</p>
                     <h3>Lists</h3>
                     <ul>
                     <?php 
                        foreach($my_lists as $l){
                            echo "<li><a href=\"/l/u-".$u->user_profile['username']."/$l[short_name]\">$l[short_name]</a></li>";
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
