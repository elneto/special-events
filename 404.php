<?php get_header(); ?>

    <div class="container pad-top">
        <div class="row">
            <div class="col-md-8">

            	<!-- section -->
            	<section role="main">

            		<!-- article -->
            		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            			<h1><?php _e( 'Page not found', 'felix' ); ?></h1>
            			<h2>
            				<a href="<?php echo home_url(); ?>"><?php _e( 'Return home?', 'felix' ); ?></a>
            			</h2>

            		</article>
            		<!-- /article -->

            	</section>
            	<!-- /section -->

            </div><!--col-md-8 -->

<?php get_sidebar(); ?>

        </div><!-- /row -->
    </div><!-- /container -->

<?php get_footer(); ?>