<?php include 'includes/php_header.php'; ?>
<?php
    $problem = $u->getProblemById($_GET['p']);
    $figures = $u->getFiguresOfProblem($_GET['p']);
    $solutions = $u->getSolutions($_GET['p']);

    if(!empty($u->user_id)){
        $my_lists = $u->getMyLists();
    }
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
                                                                echo " | <a href=\"/delete_problem.php?p=$problem[id]\">Delete</a>";
                                                            }
                                                        }
                                                        ?>
                                                        </p>
                                                        <p>
                                                        <?php echo $problem['mml']; ?>
                                                        </p>
                                                        <p>
                                                        <?php
                                                            foreach($figures as $f){
                                                            echo "<img src=\"/figure.php?fig=$f\"/><br/>";
                                                            }
                                                        ?>
                                                        </p>
                                                        <?php if(!empty($u->user_id)){ ?>
                                                        <p>
                                                        <form action="/list_actions.php" method="post">
                                                        <input type="hidden" name="p" value="<?php echo $_GET['p']; ?>"/>
                                                        <select name="list_id" onchange="this.form.submit();">
                                                        <option value="">List actions</option>
                                                        <?php
                                                            foreach($my_lists as $l){
                                                                $problem_ids = explode(',',$l['problem_ids']);
                                                                if(in_array($_GET['p'], $problem_ids)){
                                                                    echo "<option value=\"$l[id]\">Remove from $l[short_name]</option>";
                                                                }
                                                                else{
                                                                    echo "<option value=\"$l[id]\">Add to $l[short_name]</option>";
                                                                }
                                                            }
                                                        ?>
                                                        </select>
                                                        </form>
                                                        </p>
                                                        <?php } ?>
                                                        <p>
                                                        <?php
                                                        foreach($solutions as $s){
                                                            $submitter_profile = $u->getUserDetails($s['submitted_by']);
                                                            echo "<h3>Solution submitted by $submitter_profile[name]</h3>";
                                                            echo "<p>$s[solution]</p>";
                                                            if($u->isAdmin()){
                                                                echo "<p><a onclick=\"return confirm('Are you sure you want to delete this solution?');\" href=\"/delete_solution.php?s=$s[id]\"><img src=\"/images/delete.png\" title=\"Delete this solution\"></a>";
                                                            }
                                                        }
                                                        ?>
                                                        </p>
                                                        <p>
                                                        <a href="/new_solution.php?p=<?php echo $problem['id']; ?>"><img src="/images/solutions.png" title="Submit a solution"></a> 
                                                        <?php
                                                        if(!empty($_SESSION['list_problems'])){
                                                            if(count($_SESSION['list_problems']) > ($_SESSION['current_list_offset'] + 1)){
                                                        ?>
                                                        | <a href="/next_in_list.php"><img src="/images/next.png" title="Next problem in my list"></a> 
                                                        | <a href="/exit_list.php">Exit list</a>
                                                        <?php }else{
                                                        ?>
                                                        | You have reached the end of the list. <a href="/exit_list.php">Exit list</a>.
                                                        <?php
                                                        } 
                                                        }
                                                        ?>
                                                        | <a href="/?r=<?php echo rand(); ?>">Next random problem</a> 
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
