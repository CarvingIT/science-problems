<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST['action'] == 'New difficulty level'){
    $u->createDifficultyLevel($_POST);
}
else if($_POST['action'] == "Update difficulty level"){
    $u->updateDifficultyLevel($_POST);
}
else if($_GET['action'] == 'delete'){
    $u->deleteDifficultyLevel($_GET['level_id']);
    //redirect back to the page without query string args
    header("location:/manage_difficulty_levels.php");
}
$levels = $u->getDifficultyLevels();
if(!empty($_GET['id'])){
    foreach($levels as $l){
        if($l['id'] == $_GET['id'])
        $edit_level = $l;
    }
}

?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Manage Users</title>
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
															<h2>Difficulty Levels</h2>
														</header>
														<p>
<span class="error"><?php echo $error; ?></span>
<span class="message"><?php echo $msg; ?></span>
														</p>
                     <form class="fullwidth" action="manage_difficulty_levels.php" method="post">
                     <label>Name</label>
                     <input type="text" name="level" value="<?php echo $edit_level['level']; ?>" required />
                     <label>Order (Enter an integer value. High value means high difficulty level.)</label>
                     <input type="text" name="level_order" value="<?php echo $edit_level['level_order']; ?>" required />
                     <?php
                     if(empty($edit_level['id'])){
                     ?>
                     <input type="submit" name="action" value="New difficulty level" />
                     <?php
                     }else{
                     ?>
                     <input type="hidden" name="level_id" value="<?php echo $edit_level['id']; ?>" />
                     <input type="submit" name="action" value="Update difficulty level" />
                     <?php
                     }
                     ?>
                     </form>
                     <table>
                     <tr>
                        <td width="50">Level</td>
                        <td width="200">Order</td>
                        <td width="200">Actions</td>
                     </tr>
                     <?php 
                        foreach($levels as $l){
                            echo "<tr>
                                <td>$l[level_order]</td>
                                <td>$l[level]</td>
                                <td><a href=\"/manage_difficulty_levels.php?id=$l[id]\"><img src=\"/images/edit.png\" alt=\"Edit Level\" /></a> <a href=\"manage_difficulty_levels.php?action=delete&level_id=$l[id]\" title=\"Delete difficulty level\"><img src=\"/images/delete.png\" /></a></td>
                                </tr>";
                        }
                     ?>
                     </table>
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
