<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		
		<title>
			<?php bloginfo('name'); ?> / <?php is_front_page() ? bloginfo('description') : wp_title(''); ?>
		</title>
		
		<!-- mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content=" <?php bloginfo('name'); echo ": "; bloginfo('description'); ?> ">
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		
		<!-- theme customizer options -->
		<?php 
			$text_color = get_option('text_color'); 
			$highlight_color = get_option('highlight_color');
			$bg_color = get_option('bg_color');
		?>
		
		<style> 
		
			body { 
				color:  <?php echo $text_color; ?>; 
			} 
			body, .nav li ul.submenu, .nav li ul.children {
				background-color:  <?php echo $bg_color; ?>;
			}
			
			a, .button, .comment-reply-link, input[type="submit"] {
				color:  <?php echo $highlight_color; ?>;
			}
			
			a:hover, 
			.button:hover, 
			.comment-reply-link:hover, 
			li.current-menu-item a,
			li.current_page_item a,
			li.current_page_ancestor a,
			input[type="submit"]:hover {
				color: <?php echo adjustBrightness($highlight_color, -35) ?>;
			}
			a:link { /* for iphones/ipads */
				-webkit-tap-highlight-color: <?php echo adjustBrightness($highlight_color, -35) ?>;
			}
			
			li.current-menu-item a:hover,
			li.current_page_item a:hover,
			li.current_page_ancestor a:hover {
				color: <?php echo adjustBrightness($highlight_color, -75) ?>;
			}
			
		</style>
		
		<!-- end theme customizer -->		
		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header class="header wrap clearfix" role="banner">
				<div id="inner-header">
					<p id="logo" class="h1">
						<?php if(get_theme_mod( 'serena_logo' )) : ?>				
							<a href="<?php echo home_url(); ?>" rel="nofollow"><img src="<?php echo get_theme_mod( 'serena_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
						<?php else : ?>				
							<a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>				
						<?php endif; ?>	
						
						
					</p>					

					<p id="blog-info"><?php bloginfo('description'); ?></p>
				</div>
		
				<nav role="navigation">
					<?php serena_main_nav(); ?>
				</nav>			
			
			</header> <!-- end header -->
