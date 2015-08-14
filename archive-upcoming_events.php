<?php get_header(); ?>

    <div class="container pad-top">
        <div class="row">
            <div class="col-xs-12">

            	<!-- section -->
            	<section role="main">

            		<h2 class="page-header"><?php _e( 'Events Schedule', 'felix' ); ?></h2>

            		<?php get_template_part('loop', 'events_calendar'); ?>

            		<?php get_template_part('pagination'); ?>
            	</section>
            	<!-- /section -->

            </div><!--col-md-8 -->

        <?php // get_sidebar(); ?>

        </div><!-- /row -->
    </div><!-- /container -->

<?php get_footer(); ?>