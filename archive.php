<?php get_header(); ?>
			
		<div id="content" class="wrap clearfix">
				
			    <div id="main" class="eightcol first clearfix" role="main">
				
				    <?php if (is_category()) { ?>
					    <h1 class="archive-title h2">
						    <?php single_cat_title(); ?>
				    	</h1>
					    
				    <?php } elseif (is_tag()) { ?> 
					    <h1 class="archive-title h2">
						    <span><?php _e("Posts Tagged:", "serena"); ?></span> <?php single_tag_title(); ?>
					    </h1>
					    
				    <?php } elseif (is_author()) { 
				    	global $post;
				    	$author_id = $post->post_author;
				    ?>
					    <h1 class="archive-title h2">

					    	<span><?php _e("Posts By:", "serena"); ?></span> <?php echo get_the_author_meta('display_name', $author_id); ?>

					    </h1>
				    <?php } elseif (is_day()) { ?>
					    <h1 class="archive-title h2">
    						<span><?php _e("Archives:", "serena"); ?></span> <?php the_time('l, F j, Y'); ?>
					    </h1>
		
	    			<?php } elseif (is_month()) { ?>
		    		    <h1 class="archive-title h2">
			    	    	<span><?php _e("Archives:", "serena"); ?></span> <?php the_time('F Y'); ?>
				        </h1>
					
				    <?php } elseif (is_year()) { ?>
				        <h1 class="archive-title h2">
				    	    <span><?php _e("Archives:", "serena"); ?></span> <?php the_time('Y'); ?>
				        </h1>
				    <?php } ?>

				    <?php
				    if (have_posts()) : while (have_posts()) : the_post();
					
						get_template_part( 'template-parts/content', 'archive' );
					
				    endwhile;
				    ?>	
					
				        <nav class="wp-prev-next">
				            <ul>
				    	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older', "serena")) ?></li>
				    	        <li class="next-link"><?php previous_posts_link(__('Newer &raquo;', "serena")) ?></li>
				            </ul>
				        </nav>	
					
				    <?php else : ?>
					
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
    
    			<?php get_sidebar(); ?>
                
			</div> <!-- end #content -->

<?php get_footer(); ?>
