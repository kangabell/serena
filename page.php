<?php get_header(); ?>
			
		<div id="content" class="wrap clearfix">
			
			    <div id="main" class="clearfix" role="main">

				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
				    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
						
					    <header class="article-header">
							
						    <h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
						
					    </header> <!-- end article header -->
					
					    <section class="entry-content clearfix" itemprop="articleBody">
						    <?php the_content(); ?>
						</section> <!-- end article section -->
						
			        	<footer class="article-footer">
							<?php wp_link_pages(); ?>
			        	</footer>
						
						<?php comments_template(); ?>
					
				    </article> <!-- end article -->
					
				    <?php endwhile; else : ?>
					
				        <article id="post-not-found" class="hentry clearfix">
				            <header class="article-header">
				        	    <h1><?php _e("Article Missing", "serena"); ?></h1>
				        	</header>
				            <section class="entry-content">
				        	    <p><?php _e("Sorry, but something is missing. Please try again!", "serena"); ?></p>
				        	</section>
				        	<footer class="article-footer">
				        	</footer>
				        </article>	
					
				    <?php endif; ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
