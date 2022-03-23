<?php
if( true == ivan_get_option('single-author-box') ) : ?>
	<div class="entry-author-meta">

		<div class="author-image">
			<?php echo get_avatar( get_the_author_meta('email') , '100' ); ?>
		</div> <!-- .author-image -->

		<div class="author-details">
			<h3><a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a></h3>

			<p>
				<?php echo get_the_author_meta( 'description' ); ?> 
			</p>

			<p class="author-meta">
				<strong><?php esc_html_e('All articles by', 'bomby'); ?>:</strong> 
				<a href="<?php echo esc_url( get_author_posts_url(get_the_author_meta( 'ID' )) ); ?>"><?php the_author(); ?></a>
			</p>

			<?php if( get_the_author_meta( 'user_url' ) != '' ) : ?>
				<p class="author-meta author-website">
					<strong><?php esc_html_e('Website', 'bomby'); ?>:</strong> 
					<a href="<?php echo esc_url( get_the_author_meta( 'user_url' ) ); ?>" target="_blank"><?php echo get_the_author_meta( 'user_url' ); ?></a>
				</p>
			<?php endif; ?>

			<div class="social-profile">
			<?php
			$ivan_user_profile_media = ivan_get_user_profile_media();
			if( is_array($ivan_user_profile_media) ) :
				foreach( $ivan_user_profile_media as $key => $social ) {
					$profile = get_the_author_meta( str_replace('-', '_', $social) );
					if( '' != $profile ) {
						echo '<a href="'. esc_url($profile) .'" class="author-social-icon" target="_blank"><i class="fa fa-'. $social .'"></i></a>';
					}
				}
			endif;
			?>
			</div>

		</div>

		<div class="clearfix"></div>

	</div><!-- .entry-author-meta -->
<?php endif; ?>