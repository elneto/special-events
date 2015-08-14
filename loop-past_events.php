<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<div class="masonry-filter" id="past-events-filter">
    <div class="container">
      <!-- iSotope Masonry Navigation -->
      <div class="col-xs-12">
        <div class="btn-group btn-input clearfix">
          <button type="button" class="btn btn-default dropdown-toggle form-control" data-toggle="dropdown">
            <span data-bind="label">Filter events by year</span> <span class="caret"></span>
          </button>
          <ul id="filter" class="option-set dropdown-menu" role="menu">
            <?php
              $terms = get_terms("event_year");
              if ( !empty($terms) && !is_wp_error($terms)) {
                  foreach ($terms as $term) {
                      echo "<li><a href=#year-" . $term->slug . ">" . $term->name . "</a></li>";
                  }
              }
            ?>
            <li><a href="#show-all">All</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>

  <!-- iSotope Masonry -->
    <div id="specialevents" class="container clearfix">
    <?php
      global $post;
      $args = array('posts_per_page' => -1, 'cat' => 1, 'meta_key' => 'event_date', 'orderby' => 'meta_value_num', 'order' => 'DESC'); // Set to unlimited, change -1 to desired limit
      $myposts = get_posts($args);
      foreach($myposts as $post) :
    ?>
      <div <?php post_class(); ?>>
        <a href="<?php the_permalink(); ?>">
          <?php
            $masonry_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
            $masonry_thumb_url = $masonry_thumb['0'];
            // $jq_date_format = 'Ymd';
            // $jq_new_date = date_create_from_format($jq_date_format, get_field('event_date'));
            // $event_date = $jq_new_date->format('d M Y');
          ?>
          <img src="<?php echo $masonry_thumb_url; ?>" class="event-thumb" alt="Thumbnail for <?php the_title(); ?>"  />
          <h4 class="event-title"><?php the_title(); ?></h4>
          <p class="masonry-date"><?php echo get_field('event_date'); ?></p>
        </a>
      </div>

    <?php endforeach; ?>
    </div>

<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h3><?php _e( 'Sorry, nothing to display.', 'felix' ); ?></h3>
	</article>
	<!-- /article -->

<?php endif; ?>