<!-- THEME CUSTOMIZER OPTIONS -->

<?php function serena_custom_css() { 
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

<?php }
	add_action('wp_head', 'serena_custom_css');
?>