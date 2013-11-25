<?php
include $_SERVER['DOCUMENT_ROOT'].'/includes/php_header.php';

if($_POST['action'] == 'Create a new list'){
    $u->createList($_POST['title']);
}
else if($_POST['action'] == 'Update'){
    $u->renameList($_POST['list_id'],$_POST['title']);
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
<form class="fullwidth" method="post" action="/my_lists.php">
<label>Name of the list</label>
<input type="text" name="title" value="<?php echo $_GET['name']; ?>" required/>
<?php
if(empty($_GET['id'])){
?>
<input name="action" type="submit" value="Create a new list"/>
<?php }else{ ?>
<input type="hidden" value="<?php echo $_GET['id']; ?>" name="list_id" />
<input name="action" type="submit" value="Update"/>
<?php } ?>
</form>
														</p>
                     <h3>Lists</h3>
                     <table>
                     <?php 
                        if(count($my_lists) == 0){
                            echo "<p>You have created no lists yet. Create one now.</p>";
                        }
                        foreach($my_lists as $l){
                            echo "<tr>
                            <td width=\"250\">
                            <a href=\"/l/u-".$u->user_profile['username']."/$l[short_name]\">$l[short_name]</a>
                            </td>
                            <td width=\"70\">
                            <a href=\"/my_lists.php?id=$l[id]&name=$l[short_name]\"><img src=\"/images/edit.png\" title=\"Rename\"></a>
                            </td>
                            <td width=\"50\">
                            <a href=\"/delete_list.php?id=$l[id]\"><img src=\"/images/delete.png\" title=\"Delete\"></a>
                            </td>
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
