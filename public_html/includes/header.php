		<!-- Header Wrapper -->
			<div id="header-wrapper">
				<div class="container">
					<div class="row">
						<div class="12u">
						
							<!-- Header -->
								<section id="header">
									
									<!-- Logo -->
										<h1><a href="/">Science problems</a></h1>
									
									<!-- Nav -->
										<nav id="nav">
											<ul>
												<li class="<?php echo isCurrent('/')?'current_page_item':''; ?>"><a href="/">Home</a></li>
												<li class="<?php echo isCurrent('/about.php')?'current_page_item':''; ?>"><a href="/about.php">About</a></li>
												<li class="<?php echo isCurrent('/contact.php')?'current_page_item':''; ?>"><a href="/contact.php">Contact</a></li>
                                                <?php if(empty($u->user_id)){ ?>
												<li class="<?php echo isCurrent('/contribute.php')?'current_page_item':''; ?>"><a href="/contribute.php">Contribute</a>
                                                <ul>
                                                    <li><a href="/login.php">Login</a></li>
                                                    <li><a href="/signup.php">Sign up!</a></li>
                                                </ul>
                                                </li>
                                                <?php }else{?>
                                                <li class="<?php echo isCurrent('/account.php')?'current_page_item':''; ?>"><a href="/account.php"><?php echo $u->user_profile['name']; ?></a>
                                                    <ul>
                                                    <li><a href="/new_problem.php">Upload a new problem</a></li>
                                                    <li><a href="/logout.php">Logout</a></li>
                                                    </ul>
                                                </li>
                                                <?php }//user menu ends ?>
											</ul>
										</nav>

								</section>

						</div>
					</div>
				</div>
			</div>

