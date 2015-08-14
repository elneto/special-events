<?php get_header(); ?>

    <div class="container pad-top">
        <div class="row">
            <div class="col-md-8">

            	<!-- section -->
            	<section role="main">

            		<h2 class="entry-title"><?php echo sprintf( __( '%s Search Results for ', 'felix' ), $wp_query->found_posts ); echo get_search_query(); ?></h2>

            		<?php get_template_part('loop'); ?>

            		<?php get_template_part('pagination'); ?>

            	</section>
            	<!-- /section -->

            </div><!--col-md-8 -->

<?php get_sidebar(); ?>

        </div><!-- /row -->
    </div><!-- /container -->

<?php get_footer(); ?>