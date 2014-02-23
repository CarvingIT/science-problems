<?php include 'includes/php_header.php'; ?>
<?php
    if(!empty($_GET['p'])){
        $problem_id = $_GET['p'];
    }
    else if(!empty($_GET['path'])){
        $problem_id = $u->getProblemIdFromPath($_GET['path']);
    }
    $problem = $u->getProblemById($problem_id);
    $figures = $u->getFiguresOfProblem($problem_id);
    $solutions = $u->getSolutions($problem_id);

    if(!empty($u->user_id)){
        $my_lists = $u->getMyLists();
    }

    $_SESSION['current_url'] = current_page_url();

if($u->isAdmin()){
    if($_POST['action'] == 'set_difficulty_level'){
        $u->setDifficultyLevel($_POST['p'], $_POST['difficulty_level']);
    }
    $problem_level = $u->getDifficultyLevelOfProblem($_GET['p']);
    $levels = $u->getDifficultyLevels();
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
                                                        <p class="no-print">
                                                        <?php
                                                        if($u->isAdmin()){
                                                            if($problem['status'] != '1'){
                                                                echo "<a href=\"/approve_problem.php?p=$problem[id]\" title=\"Approve\"><img src=\"/images/correct.png\"/></a>";
                                                            }
                                                            else{
                                                                echo "<a href=\"/disapprove_problem.php?p=$problem[id]\" title=\"Disapprove\"><img src=\"/images/wrong.png\"/></a>";
                                                            }
                                                                echo "<a href=\"/edit_problem.php?p=$problem[id]\" title=\"Edit this problem\"><img src=\"/images/edit.png\"/></a>";
                                                                echo "<a onclick=\"return confirm('Are you sure you want to delete this problem?')\" href=\"/delete_problem.php?p=$problem[id]\" title=\"Delete this problem\"><img src=\"/images/delete.png\"/></a>";
                                                        }
                                                        else if($problem['submitted_by'] == $u->user_id){
                                                                echo "<a href=\"/edit_problem.php?p=$problem[id]\" title=\"Edit this problem\"><img src=\"/images/edit.png\"/></a>";
                                                        }
                                                        ?>
                                                        </p>
                                                        <p>
                                                        <?php echo $problem['mml']; ?>
                                                        </p>
                                                        <p>
                                                        <?php
                                                            foreach($figures as $f){
                                                            echo "<img class=\"figure\" src=\"/figure.php?fig=$f\"/><br/>";
                                                            }
                                                        ?>
                                                        </p>
                                                        <?php if(!empty($u->user_id)){ ?>
                                                        <p>
                                                        <form action="/list_actions.php" method="post" class="no-print">
                                                        <input type="hidden" name="p" value="<?php echo $problem_id; ?>"/>
                                                        <select name="list_id" onchange="this.form.submit();">
                                                        <option value="">List actions</option>
                                                        <?php
                                                            foreach($my_lists as $l){
                                                                $problem_ids = explode(',',$l['problem_ids']);
                                                                if(in_array($problem_id, $problem_ids)){
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
                                                        <?php 
                                                        if($u->isAdmin()){
                                                        ?>
                                                        <form action="" method="post" class="no-print">
                                                        <input type="hidden" name="p" value="<?php echo $problem_id; ?>"/>
                                                        <input type="hidden" name="action" value="set_difficulty_level" />
                                                        <select name="difficulty_level" onchange="this.form.submit();">
                                                            <option value="">Difficulty level</option>
                                                            <?php
                                                            foreach($levels as $l){
                                                                if($problem_level == $l['id']){
                                                                    $selected = "selected";
                                                                }
                                                                else{
                                                                    $selected = "";
                                                                }
                                                                echo "<option value=\"$l[id]\" $selected>$l[level]</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                        </form>
                                                        <?php } ?>
                                                        <hr/>
                                                        <?php
                                                        foreach($solutions as $s){
                                                            $submitter_profile = $u->getUserDetails($s['submitted_by']);
                                                            echo "<h3 class=\"no-print\">Solution submitted by $submitter_profile[name]</h3>";
                                                            if($u->hasFigure($s['id'])){
                                                                echo "<img src=\"/solution_figure.php?sol=$s[id]\" /><br/>";
                                                            }
                                                            echo "$s[solution]";
                                                            if($u->isAdmin()){
                                                                echo "<a class=\"no-print\" href=\"/approve_solution.php?s=$s[id]\"><img src=\"/images/correct.png\" title=\"Approve this solution\"></a>";
                                                                echo "<a class=\"no-print\" onclick=\"return confirm('Are you sure you want to delete this solution?');\" href=\"/delete_solution.php?s=$s[id]\"><img src=\"/images/delete.png\" title=\"Delete this solution\"></a>";
                                                            }
                                                        }
                                                        ?>
                                                        <p class="no-print">
                                                        <a href="/new_solution.php?p=<?php echo $problem['id']; ?>"><img src="/images/lit_bulb.png" title="Submit a solution"></a> 
                                                        <?php
                                                        if(!empty($_SESSION['list_problems'])){
                                                            if(count($_SESSION['list_problems']) > ($_SESSION['current_list_offset'] + 1)){
                                                        ?>
                                                         <a href="/next_in_list.php"><img src="/images/next.png" title="Next problem in my list"></a> 
                                                         <a href="/exit_list.php" title="Exit list"><img src="/images/exit_list.png"/></a>
                                                        <?php }else{
                                                        ?>
                                                         You have reached the end of the list. <a href="/exit_list.php">Exit list</a>.
                                                        <?php
                                                        } 
                                                        }
                                                        ?>
                                                         <a href="/?r=<?php echo rand(); ?>"><img src="/images/reload.png" title="Next random problem"/></a> 
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
