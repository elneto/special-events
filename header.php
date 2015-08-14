<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=9,chrome=1">
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<!-- DNS Prefetch -->
		<link href="//www.google-analytics.com" rel="dns-prefetch">

		<!-- Meta -->
		<meta name="viewport" content="width=device-width">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<!-- Place all icons and favicons in project root -->

		<!-- CSS + Javascript -->
		<?php wp_head(); ?>

		<!-- Google Analytics -->
		<?php
	    if ( function_exists( 'yoast_analytics' ) ) {
	        yoast_analytics();
	    }
	  ?>
	</head>
	<body <?php body_class(); ?>>

		<!-- Wrap all page content here -->
    <div id="wrap">

			<header class="banner navbar navbar-default navbar-fixed-top" role="banner">
			  <!-- UN Global Brand Bar -->
			  <div id="un-brand-bar">
			    <div class="container">
			      <div class="col-xs-12" id="un_icon_en">
			        <a href="http://www.un.org/en/" title="United Nations Headquarters website">Welcome to the United Nations. It's your world.</a>
						</div>
			    </div>
			  </div><!-- /UN Global Brand Bar -->
			  <!-- Site Nav and Brand -->
			  <div class="container">
			    <div  id="site-nav">
			      <div class="navbar-header">
			        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			          <span class="sr-only">Toggle navigation</span>
			          <span class="icon-bar"></span>
			          <span class="icon-bar"></span>
			          <span class="icon-bar"></span>
			        </button>
			        <a class="navbar-brand brand" href="<?php echo home_url(); ?>/" title="<?php bloginfo('name'); ?>"><h1 class="sr-only"><?php bloginfo('name'); ?></h1><img src="<?php bloginfo( 'template_url' ); ?>/assets/img/se_logo.png" alt="Special Events logo" /></a>
			      </div>
			      <nav class="collapse navbar-collapse" role="navigation">
			      <?php
	            wp_nav_menu( array(
                'menu'              => 'header-menu',
                'theme_location'    => 'header-menu',
                'depth'             => 1,
                'container'         => 'div',
                'container_class'   => 'collapse navbar-collapse',
        				'container_id'      => 'menu-primary-navigation',
                'menu_class'        => 'nav navbar-nav navbar-right',
                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                'walker'            => new wp_bootstrap_navwalker())
	            );
	        	?>
	        	</nav>

			    </div>
			  </div><!-- /Site Nav and Brand -->
			</header>
