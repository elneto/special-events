<?php get_header(); ?>

    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
      <a href="#" class="prev"><i class="fa fa-chevron-left fa-3"></i></a>
      <div class="owl-carousel">
        <?php
          $temp = $wp_query;
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $post_per_page = 3; // -1 shows all posts
          $cats = array(2,129); // Categories
          $args = array(
            'post_type' => 'post',
            'category__in' => $cats,
            'paged' => $paged,
            'posts_per_page' => $post_per_page,
            'meta_key' => 'event_date',
            'orderby' => 'meta_value_num',
            'order' => 'DESC'
          );

          $wp_query = new WP_Query($args);

          if( have_posts() ) : while ($wp_query->have_posts()) : $wp_query->the_post();
          $slider_image = '';
          $slider_title = '';
          $postId = get_the_ID();
          $has_featured_image = has_post_thumbnail($postId);
          $slider_title = get_the_title();
          $slider_thumb = wp_get_attachment_image_src (get_post_thumbnail_id($post->ID), 'jumbotron');
          $slider_date_format = 'Ymd';
          $slider_new_date = date_create_from_format($slider_date_format, get_field('event_date'));
          $slider_event_date = $slider_new_date->format('d M Y');
          $slider_event_time = get_field('event_time');
          $slider_url = $slider_thumb[0];
          $slider_image = '<img src"'.$slider_url.'">';

          //code for the language switcher below
         ?>
        <div>
          <a href="<?php the_permalink(); ?>">
            <img src="<?php echo $slider_url; ?>" alt="View event &mdash; <?php echo $slider_title; ?>">
            <div class="language-switcher">
              <a href="">Spanish</a>
            </div>
            <div class="hero-unit-text">
              <?php echo $slider_title; ?>
              <p class="small"><i class="fa fa-ticket fa-2"></i> <?php echo $slider_event_date; ?><?php if ($slider_event_time): ?> at <?php echo $slider_event_time; ?> GMT <?php echo get_option('gmt_offset'); ?><?php endif; ?></p>
            </div>
          </a>
        </div>
        <?php endwhile; else: ?>
        <?php endif; wp_reset_query(); $wp_query = $temp ?>
      </div>
      <a href="#" class="next"><i class="fa fa-chevron-right fa-3"></i></a>
    </div>

    <div class="masonry-filter">
      <div class="container">
        <!-- iSotope Masonry Navigation -->
        <div class="col-xs-12 col-md-6">
          <!-- <div class="btn-group btn-input clearfix">
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
          </div> -->

          <div class="subscribe-btn btn-group">
            <a href="subscribe" title="Subscribe to our mailing list">
              <button class="btn btn-primary btn-default">
               <i class="fa fa-send"></i> Subscribe
              </button>
            </a>
          </div>
        </div>
        <div class="col-xs-12 col-md-6">
          <div class="site-search search-front">
            <?php get_template_part('searchform'); ?>
          </div>
        </div>

      </div>
    </div>

    <!-- iSotope Masonry -->
      <div id="specialevents" class="container clearfix">
      <?php
        $temp_two = $wp_query_two;
        $args_two = array(
          'posts_per_page' => 20,
          'cat' => 1,
          'meta_key' => 'event_date',
          'orderby' => 'meta_value_num',
          'order' => 'DESC'
        );

        $wp_query_two = new WP_Query($args_two);

        if( have_posts() ) : while ($wp_query_two->have_posts()) : $wp_query_two->the_post();
      ?>
        <div <?php post_class(); ?>>
          <a href="<?php the_permalink(); ?>">
            <?php
              $masonry_thumb = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail' );
              $masonry_thumb_url = $masonry_thumb['0'];
            ?>
            <img src="<?php echo $masonry_thumb_url; ?>" class="event-thumb" alt="Thumbnail for <?php the_title(); ?>"  />
            <h4 class="event-title"><?php the_title(); ?></h4>
            <p class="masonry-date"><?php echo get_field('event_date'); ?></p>
          </a>
        </div>

      <?php endwhile; else: ?>
      <?php endif; wp_reset_query(); $wp_query_two = $temp_two ?>
      </div>

      <!-- About UN Special Events
      ================================================== -->
      <div id="home-about-container">
        <div id="home-about-content">
          <?php while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
              <div class="entry-content lead">
                <?php the_content(); ?>
              </div>
            </article>
          <?php endwhile; ?>
        </div>
      </div>

<?php get_footer(); ?>