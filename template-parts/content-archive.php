<?php
/**
 * Template part for displaying results in archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
	
	<header class="article-header">
		
		<h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
		<p class="byline vcard"><?php
		  printf(__('<span class="author">%3$s</span> <time class="updated" datetime="%1$s" pubdate>%2$s</time>', 'serena'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), serena_get_the_author_posts_link());
		?></p>

	
	</header> <!-- end article header -->

	<section class="entry-content clearfix">
		<?php the_excerpt(); ?>
		<span class="float-right"><?php echo(' <a href="'. get_permalink($post->ID) . '" title="Read '.get_the_title($post->ID).'">Read on &raquo;</a>') ?></span>
	</section> <!-- end article section -->
	
	<footer class="article-footer">
		
	</footer> <!-- end article footer -->

</article> <!-- end article -->