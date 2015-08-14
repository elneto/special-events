<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="media">
			<!-- post thumbnail -->
			<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="pull-left">
					<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<div class="media-body">
				<!-- post title -->
				<h4 class="page-header media-heading">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
				</h4>
				<!-- /post title -->

				<!-- post details -->
				<span class="date"><?php the_time('j F Y'); ?> <?php the_time('g:i a'); ?></span><!--  | <span class="author"><?php _e( 'Published by', 'felix' ); ?> <?php the_author_posts_link(); ?></span> --><!--  | <span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'felix' ), __( '1 Comment', 'felix' ), __( '% Comments', 'felix' )); ?></span> -->
				<!-- /post details -->

				<?php felix_excerpt('felix_index'); // Build your custom callback length in functions.php ?>

				<?php edit_post_link(); ?>
			</div>
		</div>
	</article>
	<!-- /article -->
	<hr class="primary">
<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h2><?php _e( 'Sorry, nothing to display.', 'felix' ); ?></h2>
	</article>
	<!-- /article -->

<?php endif; ?>