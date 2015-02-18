<?php

// Adding Translation Option
load_theme_textdomain( 'serena', get_template_directory() .'/library/translation' );
	$locale = get_locale();
	$locale_file = get_template_directory() ."/library/translation/$locale.php";
if ( is_readable($locale_file) ) get_template_part($locale_file);


?>