<?php

  global $post;
  $args = array( 'post_type' => 'post', 'cat' => 2, 'posts_per_page' => 10 );
	$upcoming = new WP_Query( $args );;
	if ($upcoming->have_posts()): while ($upcoming->have_posts()) : $upcoming->the_post();?>

	<!-- article -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="col-xs-12 col-sm-2 event-date">
	    <div class="date-day">
      	<?php if (get_field('event_date') != '') : ?>
				<h5>
          <?php  
						$jq_date_format = 'Ymd';
            $jq_new_date = DateTime::createFromFormat($jq_date_format, get_field('event_date'));
            $event_date = $jq_new_date->format('d M Y');
          ?>
          <?php echo $event_date; ?>
	      </h5>
        <?php endif; ?>
	      <?php if (get_field('event_time') != '') : ?>
				<h6>
        	<?php $event_time = get_field('event_time');?>
          <?php echo $event_time; ?>
        </h6>
				<?php endif; ?>
	    </div>
	  </div>
		<div class="col-xs-8 col-sm-5">
			<!-- post title -->
			<h3 class="event-title">
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h3>
			<!-- /post title -->

			<p>
				<span id="event-info">
	      <?php if (get_field('event_date') != '') :
          $jq_date_format = 'Ymd';
          $jq_new_date = DateTime::createFromFormat($jq_date_format, get_field('event_date'));
          $event_date = $jq_new_date->format('d M Y');
        ?>
	          <i class="fa fa-calendar"></i> <span class="event-label">Date:</span> <?php echo $event_date;

	          $event_time = get_field('event_time');
	          if ($event_time): ?>
	          <span> / </span>
	          <i class="fa fa-clock-o"></i> <span class="event-label">Time:</span> <?php echo $event_time; ?> GMT <?php echo get_option('gmt_offset'); ?>
	      <?php endif;
	      	endif; ?>

	      <?php if (get_field('event_location') != '') :
	          $event_loc = get_field('event_location');?>
	          <span> / </span>
	          <i class="fa fa-map-marker"></i> <span class="event-label">Location:</span> <?php echo $event_loc; ?>
	      <?php endif; ?>
	      </span>
			</p>

			<p class="event-notes"><?php felix_excerpt('felix_index'); // Build your custom callback length in functions.php ?></p>

			<!-- post details -->
			<!-- <span class="date"><?php the_time('j F Y'); ?> <?php the_time('g:i a'); ?></span> --><!--  | <span class="author"><?php _e( 'Published by', 'felix' ); ?> <?php the_author_posts_link(); ?></span> --><!--  | <span class="comments"><?php comments_popup_link( __( 'Leave your thoughts', 'felix' ), __( '1 Comment', 'felix' ), __( '% Comments', 'felix' )); ?></span> -->
			<!-- /post details -->

			<?php edit_post_link(); ?>
		</div>
		<div class="col-xs-4 col-sm-5" id="upcoming-event-img">
		<!-- post thumbnail -->
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" class="pull-right">
				<?php the_post_thumbnail('medium'); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->
		</div>
	</article>
	<!-- /article -->
	<div class="col-xs-12">
		<hr class="primary">
	</div>
<?php endwhile; ?>

<?php else: ?>

	<!-- article -->
	<article>
		<h3><?php _e( 'Sorry, there are no upcoming events at the moment.', 'felix' ); ?></h3>
	</article>
	<!-- /article -->

<?php endif; ?>