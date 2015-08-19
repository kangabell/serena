<?php
/*
The comments section for Serena
*/

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
	  die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<div class="alert help">
	  	<p class="nocomments"><?php _e("This post is password protected. Enter the password to view comments.", "serena"); ?></p>
		</div>

	<?php
		return;
	}
?>

<!-- You can edit below. -->

<?php if ( have_comments() ) : ?>
	<h3 id="comments" class="h2"><?php __("Comments", "serena"); ?></h3>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=serena_comments'); ?>
	</ol>

	<nav id="comment-nav">
		<ul class="clearfix">
				<li><?php previous_comments_link() ?></li>
				<li><?php next_comments_link() ?></li>
		</ul>
	</nav>

<?php endif; ?>


	
<?php if ( comments_open() ) : ?>
	<section id="respond" class="respond-form">
		
		<?php
	
			comment_form(
				array(
				    'comment_notes_after'  => '',
				    'title_reply'          => '<h3 id="comment-form-title" class="h2">Leave a Reply</h3>',
				    'label_submit'         => __( 'Submit', 'serena' ),
			
				    'logged_in_as' => '<p class="comments-logged-in-as">' .
				       sprintf(
				       __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out &raquo;</a>', 'serena' ),
				         admin_url( 'profile.php' ),
				         $user_identity,
				         wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
				       ) . '</p>',
		   
				     'comment_field' =>  '<p class="comment-form-comment"><textarea name="comment" id="comment" placeholder="Thoughts" tabindex="4"></textarea></p>',
			 
					 'comment_notes_before' => '<ul id="comment-form-elements" class="clearfix">',

					  'comment_notes_after' => '</ul>',
				
				 
					 'fields' => apply_filters( 'comment_form_default_fields', array(
   	   			    
							'author' =>
		   	   			      '<li class="comment-form-author">' .
		   	   			      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
		   	   			      '" placeholder="' . __( 'Name *', 'serena' ) .
		   	   			      '" size="30" /></li>',
					
			   			    'email' =>
			   			      '<li class="comment-form-email">' .
			   			      '<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) .
			   			      '" placeholder="' . __( 'Email *', 'serena' ) .
			   			      '" size="30" /></li>',

						    'url' =>
						      '<li class="comment-form-url">' .
						      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
						      '" placeholder="' . __( 'URL', 'serena' ) .
						      '" size="30" /></li>',
				
						) // end array
						
					  ), //end apply_filters
				 
				) // end array
			); // end comment_form

		?>
	</section>
<?php endif; ?>