<!-- sidebar -->
<div class="col-md-4">
    <aside class="sidebar" role="complementary">

    	<div class="site-search search-side">
        <?php get_template_part('searchform'); ?>
        <hr class="primary" />
      </div>

      <?php if ( is_active_sidebar( 'sidebar-widget-area' ) ) : ?>

        <?php dynamic_sidebar( 'sidebar-widget-area' ); ?>

      <?php else : ?>

        <!-- This content shows up if there are no widgets defined in the backend. -->

        <div class="alert alert-info">

          <p><?php _e("Please activate some Widgets","felix"); ?>.</p>

        </div>

      <?php endif; ?>

    	<div class="sidebar-widget">
    		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-1')) ?>
    	</div>

    	<div class="sidebar-widget">
    		<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar('widget-area-2')) ?>
    	</div>

    </aside>
</div><!--/col-md-4 -->
<!-- /sidebar -->