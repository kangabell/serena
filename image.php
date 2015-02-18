<?php
/**
 * The template for displaying image attachments.
 */

get_header(); ?>

			<div id="content" class="wrap clearfix">
			
			    <div id="main" class="eightcol first clearfix" role="main">
									
				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					    <article id="post-<?php the_ID(); ?>" <?php post_class('image-attachment'); ?>>
							
						    <header class="article-header">
								
								<h1 class="entry-title single-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
						    </header> <!-- end article header -->
					
						    <section class="entry-attachment clearfix">
								<?php
								echo wp_get_attachment_image( $post->ID, $attachment_size );
								?>
						    </section> <!-- end article section -->
							
					        <nav class="image-nav">
					            <li class="prev-link"><?php previous_image_link( false, __('&laquo; Prev', "serena")) ?></li>
				    	        <li class="next-link"><?php next_image_link( false, __('Next &raquo;', "serena")) ?></li>
					        </nav>	
					
					    </article> <!-- end article -->
					    	
					
				    <?php endwhile; ?>	
					<?php endif; ?>
			
			    </div> <!-- end #main -->				    
    
			   <?php get_sidebar(); ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
