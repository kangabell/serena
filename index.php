<?php get_header(); ?>
			
			<div id="content" class="wrap clearfix">
			
				<div id="main" class="eightcol first clearfix" role="main">
					<?php query_posts("showposts=1") ?>
				    <?php the_post(); ?>
					    
						<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
							<header class="article-header">
							
								<p class="vcard"><?php
								  printf(__('<time datetime="%1$s" pubdate>%2$s</time>', 'serena'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')) );
								?></p>
								<h1 class="entry-title" itemprop="headline"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
								<p class="author"><?php
								  printf(__('by %1$s', 'serena'), serena_get_the_author_posts_link());
								?></p>
							    
						
						    </header> <!-- end article header -->
							<section class="entry-content clearfix">
								<?php the_content(); ?>
						    </section> <!-- end article section -->
						
						    <footer class="article-footer">
								<?php wp_link_pages(); ?>
						    </footer> <!-- end article footer -->
							
						</article> <!-- end article -->
							
					<?php wp_reset_query(); ?>
				</div> <!-- end main -->
									
			    <?php 
				get_template_part( 'sidebar_home' );
				?>
				
    
			</div> <!-- end #content -->

<?php get_footer(); ?>
