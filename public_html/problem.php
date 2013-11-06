<?php include 'includes/php_header.php'; ?>
<?php
    $problem = $u->getProblemById($_GET['p']);
    $solutions = $u->getSolutions($_GET['p']);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems - <?php echo $problem['title']; ?></title>
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
															<h2><?php echo $problem['title']; ?></h2>
														</header>
                                                        <p>
                                                        <?php
                                                        if($u->isAdmin()){
                                                            if($problem['status'] != '1'){
                                                                echo "<a href=\"/approve_problem.php?p=$problem[id]\">Approve</a>";
                                                            }
                                                        }
                                                        ?>
                                                        </p>
                                                        <p>
                                                        <?php echo $problem['mml']; ?>
                                                        </p>
                                                        <?php
                                                        foreach($solutions as $s){
                                                            $submitter_profile = $u->getUserDetails($s['submitted_by']);
                                                            echo "<h3>Solution submitted by $submitter_profile[name]</h3>";
                                                            echo "<p>$s[solution]</p>";
                                                            if($u->isAdmin()){
                                                                echo "<p><a onclick=\"return confirm('Are you sure you want to delete this solution?');\" href=\"/delete_solution.php?s=$s[id]\">Delete this solution</a>";
                                                            }
                                                        }
                                                        ?>
                                                        <p>
                                                        <a href="/new_solution.php?p=<?php echo $problem['id']; ?>">Submit a solution</a> 
                                                        <?php
                                                        if(!empty($_SESSION['list_problems'])){
                                                            if(count($_SESSION['list_problems']) > ($_SESSION['current_list_offset'] + 1)){
                                                        ?>
                                                        | <a href="/next_in_list.php">Next problem in my list</a> 
                                                        | <a href="/exit_list.php">Exit list</a>
                                                        <?php }} ?>
                                                        </p>
														</section>
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
