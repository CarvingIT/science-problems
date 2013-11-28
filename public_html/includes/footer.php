		<!-- Footer Wrapper -->
			<div id="footer-wrapper" class="no-print">
				
				<!-- Footer -->
					<section id="footer" class="container">
						<div class="row">
							<div class="12u">
							
								<!-- Copyright -->
									<div id="copyright">
										<ul class="links">
											<li>For the people, by the people who love science.</li>
										</ul>
									</div>

							</div>
						</div>
					</section>
				
			</div>
            <?php
                if(!empty($u->app_config['google_analytics_id'])){
            ?>
        <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '<?php echo $u->app_config['google_analytics_id']; ?>', 'scienceproblems.org');
  ga('send', 'pageview');

        </script>
            <?php
                }
            ?>

