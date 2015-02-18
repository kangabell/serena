<!doctype html>  

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->
	
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		
		<title>
			<?php wp_title('/', true, 'right'); ?>
		</title>
		
		<!-- mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content=" <?php bloginfo('name'); echo ": "; bloginfo('description'); ?> ">
				
  		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">	
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>

		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header class="header wrap clearfix" role="banner">
				<div id="inner-header">
					<p id="logo" class="h1">
						<?php if(get_theme_mod( 'serena_logo' )) : ?>				
							<a href="<?php echo esc_url(home_url('/')); ?>" rel="nofollow"><img src="<?php echo get_theme_mod( 'serena_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
						<?php else : ?>				
							<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>				
						<?php endif; ?>	
						
						
					</p>					

					<p id="blog-info"><?php bloginfo('description'); ?></p>
				</div>
		
				<nav role="navigation">
					<?php serena_main_nav(); ?>
				</nav>			
			
			</header> <!-- end header -->
