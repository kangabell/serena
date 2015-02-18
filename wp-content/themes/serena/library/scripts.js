/*

Serena Scripts File
Author: Kanga Bell

*/

/* 
load gravatars if is above or equal to 768px 
*/

jQuery(document).ready(function($) {

    var responsive_viewport = $(window).width();
    
    if (responsive_viewport >= 768) {
        $('.comment img[data-gravatar]').each(function(){
            $(this).attr('src',$(this).attr('data-gravatar'));
        });
    }
	
});