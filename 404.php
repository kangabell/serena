<?php get_header(); ?>
			
			<div id="content" class="wrap clearfix">
			
					<div id="main" class="clearfix" role="main">

						<article id="post-not-found" class="hentry clearfix">
						
							<header class="article-header">
							
								<h1><?php _e("Page Missing", "serena"); ?></h1>
						
							</header> <!-- end article header -->
					
							<section class="entry-content">
							
								<p><?php _e("Sorry, but nothing was found here.<br /> Maybe try a search?", "serena"); ?></p>
					
							</section> <!-- end article section -->

							<section class="search">
				
							    <p><?php get_search_form(); ?></p>
				
							</section> <!-- end search section -->
						
							<footer class="article-footer">
							
							</footer> <!-- end article footer -->
					
						</article> <!-- end article -->
			
					</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
