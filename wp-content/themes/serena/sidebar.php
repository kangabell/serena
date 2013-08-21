				<div id="sidebar_blog" class="sidebar fourcol last clearfix" role="complementary">

					<?php if ( is_active_sidebar( 'sidebar_blog' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar_blog' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
						<div class="alert help">
							<p><?php _e("Please activate some Widgets.", "serena");  ?></p>
						</div>

					<?php endif; ?>

				</div>