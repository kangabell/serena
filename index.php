<?php get_header(); ?>
			
	<div id="content" class="wrap clearfix">

		<div id="main" class="eightcol first clearfix" role="main">
							
			<?php
			if (have_posts()) : while (have_posts()) : the_post();

				get_template_part( 'template-parts/content' );

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
