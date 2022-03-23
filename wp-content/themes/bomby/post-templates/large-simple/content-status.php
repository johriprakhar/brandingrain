<?php
/**
 * @package ivan_framework
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-inner">
		
		<header class="entry-header">

			<?php
			// Meta
			get_template_part('post-templates/parts/part', 'meta'); ?>

		</header><!-- .entry-header -->

		<div class="entry-content">

			<i class="status-mark fa fa-twitch pull-left"></i>

			<div class="status-main">
				<?php the_content(); ?>
			</div>
		</div><!-- .entry-content -->
		<?php
		// Read More
		get_template_part('post-templates/parts/part', 'read-more'); ?>

	</div><!-- .entry-inner -->

</article><!-- #post-## -->