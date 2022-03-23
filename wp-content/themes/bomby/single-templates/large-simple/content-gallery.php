<?php
/**
 * @package ivan_framework
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

				<?php
				// Meta
				get_template_part('post-templates/parts/part', 'meta-no-comments'); ?>
				
				<?php
				// Title
				get_template_part('post-templates/parts/part', 'title-nolink'); ?>

			</header><!-- .entry-header -->

	<?php
		$oArgs = Ivan_ThemeArguments::getInstance('ivan_current_post');
		$ivan_current_post = $oArgs -> get('ivan_current_post');

		$ivan_current_post['content'] = get_the_content( '' );

		$oArgs -> set('ivan_current_post', $ivan_current_post);

		// Displays thumbnail if exists and considering the Post Format being used
		do_action( 'ivan_display_thumbnail', 'gallery' ); 

		$ivan_current_post = $oArgs -> get('ivan_current_post');
	?>

	<div class="entry-inner">
		<div class="single-content-wrapper">

			<div class="entry-content">
				<?php
				// Content
				echo apply_filters( 'the_content', $ivan_current_post['content'] ); // Replaces the_content function call ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">',
						'after'  => '</div>',
						'link_before' => '<span>',
						'link_after' => '</span>',
					) );
				?>

				<?php
				// Dynamic Area
				get_template_part('single-templates/parts/part', 'dynamic-area'); ?>

				<?php
				// Tags
				get_template_part('single-templates/parts/part', 'tags'); ?>

				<?php
				// Post Nav
				get_template_part('single-templates/parts/part', 'post-nav-fixed'); ?>

			</div><!-- .entry-content -->

		</div><!-- .single-content-wrapper -->
	</div><!-- .entry-inner -->
	
	<?php
	// Author Box
	get_template_part('single-templates/parts/part', 'author-box'); ?>

	<?php
	// Related
	get_template_part('single-templates/parts/part', 'post-related'); ?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template
		if ( comments_open() || '0' != get_comments_number() ) :
			comments_template();
		endif;
	?>

</article><!-- #post-## -->