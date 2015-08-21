<?php

/*

Serena Theme Functions
Author: Kanga Bell Co.
URL: htp://kangabell.co

*/

/************* BASICS ***************/

// set maximum allowed width for content
if ( ! isset( $content_width ) )
	$content_width = 1140;

// remove WP version from RSS
add_filter('the_generator', 'serena_rss_version');
// remove pesky injected css for recent comments widget
add_filter( 'wp_head', 'serena_remove_wp_widget_recent_comments_style', 1 );
// clean up comment styles in the head
add_action('wp_head', 'serena_remove_recent_comments_style', 1);
// clean up gallery output in wp
add_filter('gallery_style', 'serena_gallery_style');

// enqueue base scripts and styles
add_action('wp_enqueue_scripts', 'serena_scripts_and_styles', 999);
// ie conditional wrapper
add_filter( 'style_loader_tag', 'serena_ie_conditional', 10, 2 );

// launching this stuff after theme setup
add_action('after_setup_theme','serena_theme_support');
// adding sidebars to Wordpress (these are created in functions.php)
add_action( 'widgets_init', 'serena_register_sidebars' );
// adding the serena search form (created in functions.php)
add_filter( 'get_search_form', 'serena_wpsearch' );

// cleaning up random code around images & blockquotes
add_filter('the_content', 'serena_filter_ptags_on_images');
add_filter('the_content', 'serena_filter_ptags_on_blockquotes');
// cleaning up excerpt
add_filter('excerpt_more', 'serena_excerpt_more');

// translation
get_template_part( 'library/translation', 'translation' );
require_once('library/translation/translation.php');

/*********************
CLEANUP
*********************/

// remove WP version from RSS
function serena_rss_version() { return ''; }

// remove WP version from scripts
function serena_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove injected CSS for recent comments widget
function serena_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function serena_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function serena_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

// remove the p from around imgs & blockquotes (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function serena_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
function serena_filter_ptags_on_blockquotes($content){
   return preg_replace('|<p><blockquote([^>]*)>|i', "<blockquote$1><p>", $content);
}

// Change "[...]more>>" to nothing.
function serena_excerpt_more($more) {
	global $post;
	return '';
}

/*
 * Modified the_author_posts_link(). Needed to allow usage of the usual l10n process with printf().
 */
function serena_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s', 'serena' ), get_the_author() ) ),
		get_the_author()
	);
	return $link;
}


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading jquery and reply script
function serena_scripts_and_styles() {
  if (!is_admin()) {

    // register main stylesheet
    wp_register_style( 'serena-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.min.css', array(), '', 'all' );

    // ie-only style sheet
    wp_register_style( 'serena-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.min.css', array(), '' );
	
	// theme customizer styles
	require get_template_directory() . '/library/custom-styles.php';

    // comment reply script for threaded comments
    if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
      wp_enqueue_script( 'comment-reply' );
    }

    //adding scripts file in the footer
    wp_register_script( 'serena-js', get_stylesheet_directory_uri() . '/library/scripts.js', array( 'jquery' ), '', true );

    // enqueue styles and scripts
    wp_enqueue_script( 'serena-modernizr' );
    wp_enqueue_style( 'serena-stylesheet' );
    wp_enqueue_style('serena-ie-only');
    /*
    I recommend using a plugin to call jQuery
    using the google cdn. That way it stays cached
    and your site will load faster.
    */
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'serena-js' );

  }
}

// adding the conditional wrapper around ie stylesheet
// source: http://code.garyjones.co.uk/ie-conditional-style-sheets-wordpress/
function serena_ie_conditional( $tag, $handle ) {
	if ( 'serena-ie-only' == $handle )
		$tag = '<!--[if lt IE 9]>' . "\n" . $tag . '<![endif]-->' . "\n";
	return $tag;
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function serena_theme_support() {

	// rss thingy
	add_theme_support('automatic-feed-links');

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'main-nav' => __( 'The Main Menu', 'serena' ),   // main nav in header
		)
	);
	
} /* end serena theme support */


/*********************
MENUS & NAVIGATION
*********************/

// the main menu
function serena_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu(array(
    	'container' => false,                           // remove nav container
    	'container_class' => 'menu clearfix',           // class of container
    	'menu' => __( 'The Main Menu', 'serena' ),  // nav name
    	'menu_class' => 'nav top-nav clearfix',         // adding custom nav class
    	'theme_location' => 'main-nav',                 // where it's located in the theme
        'depth' => 2,                                   // limit the depth of the nav
    	'fallback_cb' => 'serena_main_nav_fallback'      // fallback function
	));
} /* end serena main nav */


/************* MODIFIED TITLE ********************/
// makes a nicely formatted title to go in the head of the document

function serena_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	return $title;
}
add_filter( 'wp_title', 'serena_wp_title', 10, 2 );


/************* ACTIVE SIDEBARS ********************/

function serena_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar_blog',
    	'name' => __('Blog Sidebar', 'serena'),
    	'description' => __('The widget area for the blog pages.', 'serena'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'sidebar_page',
    	'name' => __('Page Sidebar', 'serena'),
    	'description' => __('The sidebar for the "w/Sidebar" page template.', 'serena'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    register_sidebar(array(
    	'id' => 'sidebar_search',
    	'name' => __('Search Sidebar', 'serena'),
    	'description' => __('The sidebar for the search form results page.', 'serena'),
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
}

/************* COMMENT LAYOUT *********************/
		
// Comment Layout
function serena_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
			    <!-- custom gravatar call -->
			    <?php
			    	// create variable
			    	$bgauthemail = get_comment_author_email();
			    ?>
			    <img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5($bgauthemail); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
			    <!-- end custom gravatar call -->
				<?php printf(__('<cite class="fn">%s</cite>', 'serena'), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__('F jS, Y', 'serena')); ?> </a></time>
				<?php edit_comment_link(__('(Edit)', 'serena'),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="alert info">
          			<p><?php _e('Your comment is awaiting moderation.', 'serena') ?></p>
          		</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
    <!-- </li> is added by WordPress automatically -->
<?php
} // don't remove this bracket!



/************* SEARCH FORM LAYOUT *****************/

// Search Form
function serena_wpsearch($form) {
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="' . get_search_query() . '" name="s" id="s" />
    </form>';
    return $form;
}


/************* THEME CUSTOMIZER *****************/

function serena_customize_register( $wp_customize )
{
	// LOGO
	
	$wp_customize->add_setting( 'serena_logo', array(
		'sanitize_callback' => 'esc_url_raw',
	) );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'serena_logo', array(
	    'label'    => __( 'Logo', 'serena' ),
	    'section'  => 'title_tagline',
	    'priority' => 1,
	    'settings' => 'serena_logo',
	) ) );
	
	// COLORS
	$colors = array();
	  $colors[] = array( 'slug'=>'text_color', 'default' => '#393939', 'label' => __( 'Text Color', 'serena' ) );
	  $colors[] = array( 'slug'=>'highlight_color', 'default' => '#689de0', 'label' => __( 'Highlight Color', 'serena' ) );
	  $colors[] = array( 'slug'=>'bg_color', 'default' => '#fefefe', 'label' => __( 'Background Color', 'serena' ) );

	  foreach($colors as $color)
	  {
	    $wp_customize->add_setting( $color['slug'], array( 
	    	'default' => $color['default'], 
	    	'type' => 'option', 
	    	'capability' => 'edit_theme_options', 
	    	'sanitize_callback' => 'sanitize_hex_color' ));

	    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 
			'label' => $color['label'], 
			'section' => 'colors', 
			'settings' => $color['slug'] 
		) ) );
	  }
}

add_action( 'customize_register', 'serena_customize_register' );

	function adjustBrightness($hex, $steps) {
	    // Steps should be between -255 and 255. Negative = darker, positive = lighter
	    $steps = max(-255, min(255, $steps));

	    // Format the hex color string
	    $hex = str_replace('#', '', $hex);
	    if (strlen($hex) == 3) {
	        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
	    }

	    // Get decimal values
	    $r = hexdec(substr($hex,0,2));
	    $g = hexdec(substr($hex,2,2));
	    $b = hexdec(substr($hex,4,2));

	    // Adjust number of steps and keep it inside 0 to 255
	    $r = max(0,min(255,$r + $steps));
	    $g = max(0,min(255,$g + $steps));  
	    $b = max(0,min(255,$b + $steps));

	    $r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
	    $g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
	    $b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);

	    return '#'.$r_hex.$g_hex.$b_hex;
	}

/************* RECENT POST EXCERPTS WIDGET *****************/
/* (based on "Recent Post with Excerpts" plugin by Stephanie Leary) */

class RecentPostExcerpts extends WP_Widget {

	function RecentPostExcerpts() {
			$widget_ops = array('classname' => 'recent_with_excerpt', 'description' => __( 'Excerpts of the most recent posts', 'serena') );
			$this->__construct('RecentPostExcerpts', __('Recent Post Excerpts', 'serena'), $widget_ops);
	}
	
	function widget( $args, $instance ) {
			extract( $args );

			echo $before_widget;
			
			// retrieve last n blog posts
			$q = array(
				'posts_per_page' => $instance['numexcerpts'], 
				'offset' => $instance['offset']
			);
			$rpwe = new wp_query($q);
			$excerpts = $instance['numexcerpts'];
				  
			// the Loop
			if ($rpwe->have_posts()) :
			while ($rpwe->have_posts()) : $rpwe->the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?> role="article">
				    <header class="article-header">		
						<p class="vcard"><?php
						  printf(__('<time datetime="%1$s" pubdate>%2$s</time>', 'serena'), get_the_time('Y-m-j'), get_the_time(get_option('date_format')) );
						?></p>
						<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>					   	
				    </header> <!-- end article header -->
                
					 
	                <?php
	                if ($excerpts > 0) { // show the excerpt ?>
	                    <?php 
	                    // the excerpt of the post
	                    the_excerpt();
	                    if (!empty($instance['more_text'])) { ?>
						
								<a href="<?php the_permalink(); ?>"><span class="float-right"><?php echo $instance['more_text']; } ?></span></a>
						
	                     <?php
	                    $excerpts--;
			        }?>
			    </article>
					
                
			<?php endwhile; endif; ?>
			</ul>
			<?php
			echo $after_widget;
			wp_reset_query();
	}
	
	
	function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			$instance['offset'] = $new_instance['offset'];
			$instance['numexcerpts'] = $new_instance['numexcerpts'];
			$instance['more_text'] = strip_tags($new_instance['more_text']);
			$instance['words'] = strip_tags($new_instance['words']);
			return $instance;
	}

	function form( $instance ) {
		if (get_option('show_on_front') == 'page')
				$link = get_permalink(get_option('page_for_posts'));
			else $link = get_permalink(home_url());
			
			//Defaults
				$instance = wp_parse_args( (array) $instance, array( 
						'offset' => 1,
						'numexcerpts' => 3,
						'more_text' => 'Read on &raquo;',
						'words' => '55'));	
	?>  
       
	    <p><label for="<?php echo $this->get_field_id('numexcerpts'); ?>"><?php _e('Number of Posts:', 'serena'); ?></label> 
	    <input id="<?php echo $this->get_field_id('numexcerpts'); ?>" name="<?php echo $this->get_field_name('numexcerpts'); ?>" type="text" value="<?php echo $instance['numexcerpts']; ?>" /></p>
		
        <p><label for="<?php echo $this->get_field_id('offset'); ?>"><?php _e('Offset:', 'serena'); ?></label><br />
        <input id="<?php echo $this->get_field_id('offset'); ?>" name="<?php echo $this->get_field_name('offset'); ?>" type="text" value="<?php echo $instance['offset']; ?>" />
        <br /><small><?php _e('Omits the most recent post(s).', 'serena'); ?></small>
		</p>

        <p>
        <label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('Link text:', 'serena'); ?></label><br />
        <input id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" type="text" value="<?php echo $instance['more_text']; ?>" />
        <br /><small><?php _e('Leave blank to omit.', 'serena'); ?></small>
        </p>
		
			<?php 
	}
}

function recent_posts_with_excerpts_init() {
	register_widget('RecentPostExcerpts');
}

add_action('widgets_init', 'recent_posts_with_excerpts_init');

?>
