<?php include 'includes/php_header.php'; ?>
<?php
    $offset = $_GET['p']*10;
    $limit = 10;
    $problems = $u->searchProblems($_GET['keywords'], $offset, $limit);
    $my_lists = $u->getMyLists();
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Science problems - Search</title>
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
                <?php include $_SERVER['DOCUMENT_ROOT'].'/includes/searchbox.php'; ?>
												
												<!-- Content -->
													<article class="box is-post">
                  <?php 
                    if(count($problems) == 0){
                        echo "Your search returned no results.";
                    }
                  ?>
                                    <form name="list_actions" method="post" action="/bulk_add_list.php">
                                    <?php
                                        if(!empty($u->user_id)){
                                    ?>
                                    <select name="new_old" onchange="showHideNewListInput(this.form);">
                                        <option value="new">Create a new list</option>
                                        <option value="old">Add to existing list</option>
                                    </select>

                                    <input type="text" name="new_list_name" value="Name of your list" onfocus="if(this.value=='Name of your list'){this.value='';}" onblur="if(this.value == ''){this.value='Name of your list';}"/>
                                    <select name="list" style="display:none;">
                                        <?php
                                            foreach($my_lists as $l){
                                                echo "<option value=\"$l[id]\">$l[short_name]</option>";
                                            }
                                        ?>
                                    </select>

                                    <input type="submit" name="action" value="Add selected to List"/> 
                                    <?php
                                    }
                                    ?>
                                    <hr/>
                                                        <?php
                                                        foreach($problems as $p){
                                                            if(!empty($u->user_id)){
                                                            echo "
                                                            <div class=\"problemcheckbox\">
                                                            <input type=\"checkbox\" name=\"problem_id[]\" value=\"$p[id]\"/>
                                                            </div>
                                                            ";
                                                            }
                                                            echo "<div class=\"problemcontent\">";
                                                            if(!empty($p['path'])){
                                                                echo "$p[mml]<br/><a class=\"no-print\" title=\"Solution\" href=\"/problem/$p[path]\" title=\"$p[title]\"><img src=\"/images/lit_bulb.png\"/></a>";
                                                            }
                                                            else{
                                                                echo "$p[mml]<br/><a class=\"no-print\" title=\"Solution\" href=\"/p/$p[id]\" title=\"$p[title]\"><img src=\"/images/lit_bulb.png\"/></a>";
                                                            }
                                                            $figures = $u->getFiguresOfProblem($p['id']);
                                                            foreach($figures as $f){
                                                                echo "<img class=\"figure\" src=\"/figure.php?fig=$f\"/><br/>";
                                                            }
                                                            echo "<hr/>";
                                                            echo "</div>";
                                                        }
                                                        ?>
                                     </form>
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
