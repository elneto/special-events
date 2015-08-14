<?php
/*
 *  Felix functions are based on HTML5 Blank
 *
 *  HTML5 Blank Author: Todd Motto | @toddmotto
 *  URL: html5blank.com | @html5blank
 *  Custom functions, support, custom post types and more.
 */

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load any external files you have here

/*------------------------------------*\
	Set up the framework for
	the Admin options panel
\*------------------------------------*/

define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/functions/options-panel/inc/' );
require_once dirname( __FILE__ ) . '/functions/options-panel/inc/options-framework.php';

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width))
{
    $content_width = 900;
}

if (function_exists('add_theme_support'))
{
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    // add_image_size('large', 700, '', true); // Large Thumbnail
    // add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('schedule', 470, 300, true); // Schedule Thumbnail
    add_image_size('jumbotron', 1200, 500, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Add Support for Custom Backgrounds - Uncomment below if you're going to use
    // add_theme_support('custom-background', array(
    // 'default-color' => 'EFEFEF',
    // 'default-image' => get_template_directory_uri() . '/img/bg.png'
    // ));

    // Add Support for Custom Header - Uncomment below if you're going to use
    // add_theme_support('custom-header', array(
    // 'default-image'			=> get_template_directory_uri() . '/img/headers/default.png',
    // 'header-text'			=> false,
    // 'default-text-color'		=> '000',
    // 'width'				=> 1124,
    // 'height'			=> 198,
    // 'random-default'		=> false,
    // 'wp-head-callback'		=> $wphead_cb,
    // 'admin-head-callback'		=> $adminhead_cb,
    // 'admin-preview-callback'	=> $adminpreview_cb
    // ));

    // Enables post and comment RSS feed links to head
    add_theme_support('automatic-feed-links');

    //Seriously, does anyone ever really use post-formats?
    //add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );

    // Localisation Support
    load_theme_textdomain('felix', get_template_directory() . '/languages');
}

/*------------------------------------*\
	Functions
\*------------------------------------*/

// function felix_nav()
// {
//     wp_nav_menu(
//     array(
//         'theme_location'  => 'header-menu',
//         'menu'            => '',
//         'container'       => 'div',
//         'container_class' => 'menu-{menu slug}-container',
//         'container_id'    => '',
//         'menu_class'      => 'menu',
//         'menu_id'         => '',
//         'echo'            => true,
//         'fallback_cb'     => 'wp_page_menu',
//         'before'          => '',
//         'after'           => '',
//         'link_before'     => '',
//         'link_after'      => '<span>//</span>',
//         'items_wrap'      => '<ul>%3$s</ul>',
//         'depth'           => 0,
//         'walker'          => ''
//         )
//     );
// }


// Load Felix scripts (header.php)
function felix_header_scripts()
{
    if (!is_admin()) {

    	wp_register_script('modernizr', get_template_directory_uri() . '/assets/js/modernizr.js', array(), '2.6.2'); // Modernizr
        wp_enqueue_script('modernizr'); // Enqueue it!

        wp_deregister_script('jquery'); // Deregister WordPress jQuery
    	wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js', array(), '1.9.1'); // Google CDN jQuery
    	wp_enqueue_script('jquery'); // Enqueue it!

        wp_register_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', array(), '1.0.0', true); // Custom scripts
        wp_enqueue_script('scripts'); // Enqueue it!

        // Uncomment for production
        //wp_register_script('scripts-minified', get_template_directory_uri() . '/assets/js/scripts.min.js', array(), '1.0.0'); // Custom scripts
        //wp_enqueue_script('scripts-minified'); // Enqueue it!
    }
}

// Load Felix conditional scripts
// function felix_conditional_scripts()
// {
//     if (is_page('pagenamehere')) {
//         wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
//         wp_enqueue_script('scriptname'); // Enqueue it!
//     }
// }

// Load Felix styles
function felix_styles()
{
    wp_register_style('styles', get_template_directory_uri() . '/assets/css/style.css', array(), '1.0', 'all');
    wp_enqueue_style('styles'); // Enqueue it!

    // Uncomment for production
    // wp_register_style('styles-minified', get_template_directory_uri() . '/assets/css/style.min.css', array(), '1.0', 'all');
    // wp_enqueue_style('styles-minified'); // Enqueue it!
}

// Register Felix Navigation

function register_felix_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu' => __('Header Menu', 'felix'),
        'sub-menu' => __('Sub Menu', 'felix'),
        'sidebar-menu' => __('Sidebar Menu', 'felix')
    ));
}


// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class, love this - Credit: Starkers Wordpress Theme
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar'))
{
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Sidebar', 'felix'),
        'description' => __('This is the standard sidebar for pages...', 'felix'),
        'id' => 'sidebar-widget-area',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Register footer widgets
    register_sidebar( array(
        'name' => __( 'Footer', 'felix' ),
        'id' => 'sidebar-footer',
        'description' => __( 'Found at the bottom of every page (except 404s and optional homepage template)', 'felix' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts, Page 1, Page 2, Page 3, with Next and Previous Links, No plugin
function felix_pagination()
{
    global $wp_query;
    $big = 999999999;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function felix_index($length) // Create 20 Word Callback for Index page Excerpts, call using felix_excerpt('felix_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using felix_excerpt('felix_custom_post');
function felix_custom_post($length)
{
    return 40;
}

// Create the Custom Excerpts callback
function felix_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Custom View Article link to Post
function felix_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'felix') . '</a>';
}

// Remove Admin bar
function remove_admin_bar()
{
    return false;
}

// Remove 'text/css' from our enqueued stylesheet
function felix_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions( $html )
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
function felixgravatar ($avatar_defaults)
{
    $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
    $avatar_defaults[$myavatar] = "Custom Gravatar";
    return $avatar_defaults;
}

// Threaded Comments
function enable_threaded_comments()
{
    if (!is_admin()) {
        if (is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
            wp_enqueue_script('comment-reply');
        }
    }
}

// Custom Comments Callback
function felixcomments($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class(empty( $args['has_children'] ) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="comment-author vcard">
	<?php if ($args['avatar_size'] != 0) echo get_avatar( $comment, $args['180'] ); ?>
	<?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
	</div>
<?php if ($comment->comment_approved == '0') : ?>
	<em class="comment-awaiting-moderation"><?php _e('Your comment is awaiting moderation.') ?></em>
	<br />
<?php endif; ?>

	<div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>">
		<?php
			printf( __('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','' );
		?>
	</div>

	<?php comment_text() ?>

	<div class="reply">
	<?php comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	</div>
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; ?>
<?php }

// Register Event Year Custom Taxonomy
function custom_taxonomy() {

    $labels = array(
        'name'                       => _x( 'Event Years', 'Taxonomy General Name', 'text_domain' ),
        'singular_name'              => _x( 'Event Year', 'Taxonomy Singular Name', 'text_domain' ),
        'menu_name'                  => __( 'Event Year', 'text_domain' ),
        'all_items'                  => __( 'All Items', 'text_domain' ),
        'parent_item'                => __( 'Parent Item', 'text_domain' ),
        'parent_item_colon'          => __( 'Parent Item:', 'text_domain' ),
        'new_item_name'              => __( 'New Item Name', 'text_domain' ),
        'add_new_item'               => __( 'Add New Item', 'text_domain' ),
        'edit_item'                  => __( 'Edit Item', 'text_domain' ),
        'update_item'                => __( 'Update Item', 'text_domain' ),
        'separate_items_with_commas' => __( 'Separate items with commas', 'text_domain' ),
        'search_items'               => __( 'Search Items', 'text_domain' ),
        'add_or_remove_items'        => __( 'Add or remove items', 'text_domain' ),
        'choose_from_most_used'      => __( 'Choose from the most used items', 'text_domain' ),
        'not_found'                  => __( 'Not Found', 'text_domain' ),
    );
    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
    );
    register_taxonomy( 'event_year', array( 'post' ), $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_taxonomy', 0 );

// Append Post Class
function my_post_class( $classes ) {
    global $post;
    $terms = wp_get_object_terms( $post->ID, 'event_year' );
    foreach ( $terms as $person ) {
        $classes[] = 'year-' . $person->slug;
    }
    return $classes;
}
add_filter( 'post_class', 'my_post_class' );


// Register Custom Event Post Type
// function upcoming_events() {

//     $labels = array(
//         'name'                => _x( 'Upcoming Events', 'Post Type General Name', 'text_domain' ),
//         'singular_name'       => _x( 'Upcoming Event', 'Post Type Singular Name', 'text_domain' ),
//         'menu_name'           => __( 'Upcoming', 'text_domain' ),
//         'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
//         'all_items'           => __( 'All Upcoming Events', 'text_domain' ),
//         'view_item'           => __( 'View Upcoming Event', 'text_domain' ),
//         'add_new_item'        => __( 'Add Upcoming Event', 'text_domain' ),
//         'add_new'             => __( 'Add Upcoming Event', 'text_domain' ),
//         'edit_item'           => __( 'Edit Upcoming Event', 'text_domain' ),
//         'update_item'         => __( 'Update Upcoming Event', 'text_domain' ),
//         'search_items'        => __( 'Search Upcoming Event', 'text_domain' ),
//         'not_found'           => __( 'Not found', 'text_domain' ),
//         'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
//     );
//     $rewrite = array(
//         'slug'                => 'upcoming-events',
//         'with_front'          => true,
//         'pages'               => true,
//         'feeds'               => true,
//     );
//     $args = array(
//         'label'               => __( 'event', 'text_domain' ),
//         'description'         => __( 'Event post type for populating the upcoming events calendar', 'text_domain' ),
//         'labels'              => $labels,
//         'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom-fields', ),
//         'taxonomies'          => array( 'category', 'post_tag', 'event_year' ),
//         'hierarchical'        => false,
//         'public'              => true,
//         'show_ui'             => true,
//         'show_in_menu'        => true,
//         'show_in_nav_menus'   => true,
//         'show_in_admin_bar'   => true,
//         'menu_position'       => 5,
//         'menu_icon'           => '',
//         'can_export'          => true,
//         'has_archive'         => true,
//         'exclude_from_search' => true,
//         'publicly_queryable'  => true,
//         'rewrite'             => $rewrite,
//         'capability_type'     => 'post',
//     );
//     register_post_type( 'upcoming_events', $args );

// }

// Hook into the 'init' action
// add_action( 'init', 'upcoming_events', 0 );

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'felix_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'felix_conditional_scripts'); // Add Conditional Page Scripts
add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'felix_styles'); // Add Theme Stylesheet
add_action('init', 'register_felix_menu'); // Add Felix Menu

// add_action('init', 'create_post_type_felix'); // Add our Felix Custom Post Type

add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'felix_pagination'); // Add our HTML5 Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
add_filter('avatar_defaults', 'felixgravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
add_filter('excerpt_more', 'felix_view_article'); // Add 'View Article' button instead of [...] for Excerpts


// add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar


add_filter('style_loader_tag', 'felix_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether


//Remove Admin stuff we don't want like posts and comments
/*
add_action( 'admin_menu', 'my_remove_menu_pages' );

function my_remove_menu_pages() {
	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');
}
*/

//Remove the visual editor for EVERYBODY.
//add_filter ( 'user_can_richedit' , create_function ( '$a' , 'return false;' ) , 50 );

//Remove auto <p> tags per http://codex.wordpress.org/Function_Reference/wpautop
//Normally, this is a pretty bad idea. But if youre gonna do it, might as well make it easy for you.
//Looking under notes, Wordpress codex seems to deem this okay.
//remove_filter( 'the_content', 'wpautop' );

//Initialize the framework for custom admin metaboxes (https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress)
add_action('init', 'include_metabox');
function include_metabox() {
    // use correct path here
    require_once get_stylesheet_directory() . '/functions/metabox/init.php';
}

//Now, get the metaboxes
require_once("functions/metaboxes.php");

// Register Custom Navigation Walker
require_once('functions/wp_bootstrap_navwalker.php');

//Get the custom post types
require_once("functions/custom-post-types.php");

//Get the custom shortcodes
require_once("functions/shortcodes.php");

/*--------------------------------------*\
    Below Added by Ernesto on 08.14.2015
\*--------------------------------------*/

function icl_post_languages(){
  $languages = icl_get_languages('skip_missing=1');
  if(1 < count($languages)){
    echo ('<div class="language-switcher">');
    foreach($languages as $l){
      if(!$l['active']) $langs[] = '<a href="'.$l['url'].'">'.$l['translated_name'].'</a>';
    }
    echo join(' | ', $langs);
    echo ('</div>');
  }
}

?>