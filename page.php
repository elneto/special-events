<?php get_header(); ?>

    <div class="container pad-top">
        <div class="row">
            <div class="col-md-8">

            	<!-- section -->
            	<section role="main">

            		<h2 class="page-header"><?php the_title(); ?></h2>

            	<?php if (have_posts()): while (have_posts()) : the_post(); ?>

            		<!-- article -->
            		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                       
            			<?php the_content(); ?>

            			<?php // comments_template( '', true ); // Commented out - enable if you want to see comments ?>

            			<br class="clear">

            			<?php edit_post_link(); ?>

            		</article>
            		<!-- /article -->

            	<?php endwhile; ?>

            	<?php else: ?>

            		<!-- article -->
            		<article>

            			<h2><?php _e( 'Sorry, nothing to display.', 'felix'  ); ?></h2>

            		</article>
            		<!-- /article -->

            	<?php endif; ?>

            	</section>
            	<!-- /section -->

            </div><!--col-md-8 -->

            <?php get_sidebar(); ?>

        </div><!-- /row -->
    </div><!-- /container -->

<?php get_footer(); ?>