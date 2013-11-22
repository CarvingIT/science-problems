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
												<li class="<?php echo isCurrent('/about.php')?'current_page_item':''; ?>"><a href="/about.php">About</a>
                                                <ul>
                                                    <li><a href="/l/latest">Latest submissions</a></li>
                                                    <li><a href="/credits.php">Credits</a></li>
                                                </ul>
                                                </li>
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
                                                    <li><a href="/my_lists.php">My lists</a></li>
                                                    <li><a href="/l/u-<?php echo $u->user_profile['username']; ?>/all">All my problems</a></li>
                                                    <li><a href="/logout.php">Logout</a></li>
                                                    </ul>
                                                </li>
                                                <?php if($u->isAdmin()){ ?>
                                               <li><a href="#">Administer</a>
                                               <ul>
                                                    <li><a href="/configuration.php">Configuration</a></li>
                                                    <li><a href="/manage_users.php">Manage Users</a></li>
                                                    <li><a href="/awaiting_problems.php">Problems awaiting approval</a></li>
                                               </ul>
                                               </li>
                                                <?php
                                                }//admin menu ends
                                                }//user menu ends ?>
											</ul>
										</nav>

								</section>

						</div>
					</div>
				</div>
			</div>

