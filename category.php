<?php get_header(); ?>

    <div class="container pad-top">
        <div class="row">
            <div class="col-md-8">

            	<!-- section -->
            	<section role="main">

            		<h2 class="page-header"><?php _e( 'Categories for', 'felix' ); the_category(); ?></h2>

            		<?php get_template_part('loop'); ?>

            		<?php get_template_part('pagination'); ?>

            	</section>
            	<!-- /section -->

            </div><!--col-md-8 -->

<?php get_sidebar(); ?>

        </div><!-- /row -->
    </div><!-- /container -->

<?php get_footer(); ?>