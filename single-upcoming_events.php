<?php get_header(); ?>
  <?php
    $args = array( 'post_type' => 'post', 'cat' => 2, 'posts_per_page' => 10 );
    $loop = new WP_Query( $args );

    if (have_posts()): while (have_posts()) : the_post(); ?>
    <?php if (has_post_thumbnail()) : ?>
    <div id="hero">
      <!-- Jumbotron
      ================================================== -->
      <div class="jumbotron masthead">
        <!-- <div class="container"> -->
          <div class="video-sub" id="yt-theatre">

            <!-- Video Player -->
            <div id="player">
              <div id="video-close-button" style="display: block;"></div>
            </div>

            <?php
            $thumb_id = get_post_thumbnail_id($post->ID);
            $url = wp_get_attachment_url($thumb_id);
            $ytvid = get_field('youtube_video_id'); ?>

            <!-- Video Controls -->
            <div id="focus">
              <div id="focus-main" style="display: block;">
                <h2 class="sr-only"><?php the_title(); ?></h2>
                <?php if ($ytvid != '') : ?>
                <i class="fa fa-youtube-play fa-4 btn-watch" id="watch-event" data-ytid="<?php echo $ytvid; ?>"></i> Watch Event Video
                <?php endif; ?>
              </div>
            </div><!-- /Video Controls -->

            <div id="hero-unit">
              <?php $image = wp_get_attachment_image_src( $thumb_id, 'jumbotron' ); ?>
              <div id="single-event-bg" style="background-image: url('<?php echo $image[0]; ?>')">
                <img src="<?php echo $image[0]; ?>">
              </div>
            </div>
          </div><!--/.video-sub -->
        <!--</div>/.container -->
      </div><!--/.jumbotron -->
    </div>
    <?php endif; ?>
    <div class="container">
        <div class="row">
            <div class="col-md-8">

            	<!-- section -->
            	<section role="main">



            		<!-- article -->
            		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            			<!-- post thumbnail -->
            			<?php if ( has_post_thumbnail('small')) : // Check if Thumbnail exists ?>
            				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
            					<?php the_post_thumbnail('small'); // Fullsize image for the single post ?>
            				</a>
            			<?php endif; ?>
            			<!-- /post thumbnail -->

            			<!-- post title -->
            			<h2 class="entry-title">
            				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
            			</h2>
            			<!-- /post title -->

                        <span id="event-info">
                        <?php if (get_field('event_date') != '') :
                            $parts = strptime('get_field('event_date')', "%Y%m%d");
                            $year = $parts['tm_year'] + 1900; // 1985
                            $day = $parts['tm_mday']; // 22
                            $month = $parts['tm_mon'] + 1; // 12
                            $event_date = date('d M Y', strtotime($year/$month/$day));?>
                            <i class="fa fa-calendar"></i> <span class="event-label">Date:</span> <?php echo $event_date;

                            $event_time = get_field('event_time');?>
                            <span> / </span>
                            <i class="fa fa-clock-o"></i> <span class="event-label">Time:</span> <?php echo $event_time; ?>
                        <?php endif; ?>

                        <?php if (get_field('event_location') != '') :
                            $event_loc = get_field('event_location');?>
                            <span> / </span>
                            <i class="fa fa-map-marker"></i> <span class="event-label">Location:</span> <?php echo $event_loc; ?>
                        <?php endif; ?>
                        </span>

            			<p>
                        <?php the_tags( __( '<i class="fa fa-tags"></i> <span class="event-label">Tags:</span> ', 'felix'  ), ', ', '<br>'); // Separated by commas with a line break at the end ?></p>

                        <?php if (get_field('event_rsvp') != '') :
                            $event_loc = get_field('event_rsvp');?>
            			  <p>
                            <i class="fa fa-ticket fa-2"></i> <span class="event-label">RSVP</span> <?php echo $event_loc; ?>
                          </p>
                        <?php endif; ?>

                        <?php the_content(); // Dynamic Content ?>


                        <!-- post details -->
                        <p class="date"><em>Published: <?php the_time('j F Y'); ?> <?php the_time('g:i a'); ?></em></p> <!-- | <span class="author"><?php _e( 'Published by', 'felix' ); ?> <?php the_author_posts_link(); ?></span> | <span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'felix' ), __( '1 Comment', 'felix' ), __( '% Comments', 'felix' )); ?></span> -->
                        <!-- /post details -->

            			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>

            			<?php // comments_template(); ?>

            		</article><!-- /article -->

            	<?php endwhile; ?>

            	<?php else: ?>

        		<!-- article -->
        		<article>

        			<h3><?php _e( 'Sorry, nothing to display.', 'felix'  ); ?></h3>

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