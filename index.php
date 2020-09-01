<?php get_header(); ?>
			
			<div id="content" class="wrap clearfix">
			
			    <div id="main" class="eightcol first clearfix" role="main">
									
				    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
						
					    <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							
						    <header class="article-header">

								<p class="vcard"><?php
								  printf(__('<time datetime="%1$s" pubdate>%2$s</time>', 'serena'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')) );
								?></p>
								<h2 class="entry-title single-title h1" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
								<p class="author"><?php echo serena_get_the_author_posts_link(); ?></p>

						    </header> <!-- end article header -->
					
						    <section class="entry-content clearfix">
							    <?php the_content(); ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
						    </footer> <!-- end article footer -->
					
					    </article> <!-- end article -->
					    	
					
				    <?php endwhile; ?>	
						
				        <nav class="wp-prev-next">
				            <ul>
				    	        <li class="prev-link"><?php next_posts_link(__('&laquo; Older', "serena")) ?></li>
				    	        <li class="next-link"><?php previous_posts_link(__('Newer &raquo;', "serena")) ?></li>
				            </ul>
				        </nav>					

				    <?php else : ?>
					
				        <article id="post-not-found" class="hentry clearfix">
				            <header class="article-header">
				        	    <h2 class="h1"><?php _e("Article Missing", "serena"); ?></h2>
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
