<?php
/**
 * Functions
 * @package      genexus
 * @author       Stacy Mark <stacy.mark@kaff.com>
 * @copyright    Copyright (c) 2017
 * @license      All Rights Reserved
 *
 */


// NEED TO DO

// build PTO plugin



//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'genesis-sample', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'genesis-sample' ) );

//* Add Image upload and Color select to WordPress Theme Customizer
require_once( get_stylesheet_directory() . '/lib/customize.php' );

//* Include Customizer CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );


//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Genexus (Geneis Child with Bourbon Neat' );
define( 'CHILD_THEME_URL', '' );
define( 'CHILD_THEME_VERSION', '2.2.4' );



/**********************************************************/
//* Enqueue Scripts and Styles

//FRONTEND
function gx_enqueue_reqs() {

	//load the WP included jquery ... into head
	wp_enqueue_script( 'jquery');

	//wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	//* Remove default stylesheet
	wp_deregister_style( 'genesis-sample-theme' );

	//* Add compiled stylesheet
	wp_register_style( 'gx-styles', get_stylesheet_directory_uri() . '/style.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'gx-styles' );

	//wp_enqueue_script( 'gx-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	//$output = array(
	//	'mainMenu' => __( '', 'genesis-sample' ),
	//	'subMenu'  => __( '', 'genesis-sample' ),
	//);
	//wp_localize_script( 'gx-responsive-menu', 'genesisSampleL10n', $output );

	//* Add compiled JS
	wp_enqueue_script( 'gx-scripts', get_stylesheet_directory_uri() . '/js/script.min.js', array(), CHILD_THEME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'gx_enqueue_reqs' );

//BACKEND load scripts, styles, fonts
function gx_admin_reqs(){
	// Enqueue jQuery Datepicker + jQuery UI CSS
	//this fixes jquery ajax error
    wp_register_script( 'admin-scripts', get_stylesheet_directory_uri() . '/js/adminscripts.min.js' );
    wp_enqueue_script( 'admin-scripts' );
    //ready the WP included datepicker
    wp_enqueue_script( 'jquery-ui-datepicker', true );
    //ready the datepicker styles
	wp_register_style( 'jquery-ui-style', get_stylesheet_directory_uri() . '/js/jquery-ui-1.11.4.custom/jquery-ui.min.css', false, '1.11.4');
	wp_enqueue_style( 'jquery-ui-style' );
}
add_action( 'admin_enqueue_scripts', 'gx_admin_reqs');



/**********************************************************/
// Add Genesis Supports and Tweaks

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

//* Add Accessibility support
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
// add_theme_support( 'custom-header', array(
// 	'width'           => 600,
// 	'height'          => 160,
// 	'header-selector' => '.site-title a',
// 	'header-text'     => false,
// 	'flex-height'     => true,
// ) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add Image Sizes
add_image_size( 'featured-image', 680, 400, TRUE );

//* Rename primary and secondary navigation menus
add_theme_support( 'genesis-menus' , array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );


/** Unregister site layouts */
//genesis_unregister_layout( 'sidebar-content' );
//genesis_unregister_layout( 'full-width' );
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );


// SIDEBARS

//* Unregister Genesis sidebars
// Remove default sidebar */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
// Remove secondary sidebar */
//unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );



// Register Our Sidebars
// local pages (community/whats/concerts) sidebar
// genesis_register_sidebar( array(
//     'id' => 'sidebar-local',
//     'name' => 'Local Pages Sidebar',
//     'description' => 'Local Pages Sidebar',
// ));

// primary (common) sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-primary',
    'name' => 'Primary Sidebar',
    'description' => 'Primary Sidebar',
));

// Home sidebar
genesis_register_sidebar( array(
    'id' => 'sidebar-homepage',
    'name' => 'Home Page Sidebar',
    'description' => 'Home Page Sidebar',
));


// Tell Genesis to use our custom sidebar based on category/page/etc
// the tpl file does all the work
function gx_custom_sidebar() {
    get_template_part( 'templates/sidebars' );
}
//add_action( 'genesis_before_sidebar_widget_area', 'gx_custom_sidebar' );



/**********************************************************/
// NAV
//* Reduce the secondary navigation menu to one level depth
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );



// Tell WP to use our Superfish JS arguments instead of defaults
/**
* Filter in URL for custom Superfish arguments.
* @author Gary Jones
* @link http://code.garyjones.co.uk/change-superfish-arguments
* @param string $url Existing URL.
* @return string Amended URL.
*/
function prefix_superfish_args_url( $url ) {
    return get_stylesheet_directory_uri() . '/js/superfish-args.min.js';
}
add_filter( 'genesis_superfish_args_url', 'prefix_superfish_args_url' );



/**********************************************************/
// ADD MORE BTNS TO EDITOR
function add_more_buttons($buttons) {
 $buttons[] = 'hr';
 $buttons[] = 'del';
 $buttons[] = 'sub';
 $buttons[] = 'sup';
 $buttons[] = 'fontselect';
 $buttons[] = 'fontsizeselect';
 $buttons[] = 'cleanup';
 $buttons[] = 'styleselect';
 return $buttons;
}
add_filter("mce_buttons_3", "add_more_buttons");





/**********************************************************/
// ADD THINGS TO PAGE HEAD

//* Add SVG definitions to <head>.
function genesis_sample_include_svg_icons() {

	// Define SVG sprite file.
	$svg_icons = get_template_directory() . 'images/svg-icons.svg';

	// If it exsists, include it.
	if ( file_exists( $svg_icons ) ) {
		require_once( $svg_icons );
	}
}
add_action( 'wp_head', 'genesis_sample_include_svg_icons', 999 );

// copyright meta
add_action( 'genesis_meta', 'gx_meta_info' );
function gx_meta_info(){
    ?>
    <meta name="author" content="Great Circle Media">
    <meta name="dcterms.dateCopyrighted" content="2015">
    <meta name="dcterms.rights" content="All Rights Reserved">
    <meta name="dcterms.rightsHolder" content="Great Circle Media">
    <?php
}
//add_action('wp_head', 'gx_meta_info');

//add animate to front page
function gx_add_to_head(){
    if( is_front_page() ){
        echo "<link type='text/css' rel='stylesheet' href='/wp-content/themes/genexus/assets/styles/animate/animate.min.css'>";
	}
}
//add_action('wp_head', 'gx_add_to_head');




/**********************************************************/
// ADD CPT'S TO ARCHIVES
// make archives include custom post types
function namespace_add_custom_types( $query ) {
    if( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) {
        $query->set( 'post_type', array(
            'post', 'nav_menu_item', 'whats-happening', 'concert', 'community-info', 'splash-post',
        ));
        return $query;
    }
}




/**********************************************************/
// CUSTOMIZE OUR HEADER
//remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
//remove_action( 'genesis_header', 'genesis_do_header' );
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );

//move prim menu above hdr
//remove_action( 'genesis_after_header', 'genesis_do_nav' );
//add_action( 'genesis_before_header', 'genesis_do_nav' );

// logo or text (chosen in theme customization)
// -- replaced with ours gx_site_title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// tagline
//remove_action( 'genesis_site_description', 'genesis_seo_site_description');



// Change site title (logo / "header left") to ours
function gx_site_title(){

    global $post;

    //====== OTHER HDR ======//
    $some_test_condition = false;
    if( $some_test_condition === true ) :  ?>
                
        <div class="some-other-logo-header">
            <a href="/"><img src="<?php echo get_stylesheet_directory_uri(); //default as placeholder ?>/images/genexus-logo.png" class="logo"></a>
        </div>

    <?php else :
    //====== DEFAULT HDR ======// ?>
    
        <div class="hdr-nav-logo">
            <a href="/"><img src="<?php echo get_stylesheet_directory_uri();?>/images/genexus-logo.png" class="logo"></a>
        </div>

    <?php endif;
}
add_action( 'genesis_site_title', 'gx_site_title' );



// Customize genesis_header_right (shows above default stuff in genesis_header_right)
function gx_header_right(){

    global $post;
    ?>

	<?php //===== HDR NAV ICONS =====// ?>
	<div class="hdr-nav-icons">
	    <?php get_template_part( 'templates/hdr-nav-icons' ); ?>
	</div>


	<?php //===== SEARCH SHOW/HIDE =====// ?>
    <div class="searchbar search-hide hide-me">
        <form class="searchbar-form hide-me" itemprop="" itemscope="" itemtype="http://schema.org/SearchAction" method="get" action="<?php echo home_url('/'); ?>" role="search">
            <meta itemprop="target" content="<?php echo home_url('/'); ?>?s={s}">
            <input itemprop="query-input" type="search" name="s" placeholder="Search" class="search-field">
            <button type="submit" class="btn-search">Search</button>
        </form>
    </div>
    <br class="clearfix">

    <?php

}
add_action( 'genesis_header_right', 'gx_header_right' );



// ****** NOT USED ************
// custom header
function custom_header() {
    global $post;
    if( $post->post_name === 'kaff-news' || in_category( check_current_category_for_news() ) || $post->post_name == 'about-kaff-news' || $post->post_name == 'contact-kaff-news' ) {
        //remove default page header
        remove_action( 'genesis_header', 'genesis_do_header' );
        function custom_do_header(){
            ?>
            <div class="title-area">
                <?php //===== LOGO ===== ?>
                <div class="hdr-nav-logo">
                    <a href="/kaff-news"><img src="<?php echo get_stylesheet_directory_uri();?>/images/kaff-news-logo.png"></a>
                </div>
            </div>
            <?php
        }
        add_action( 'genesis_header', 'custom_do_header' );
    }
}
//add_action( 'wp', 'custom_header' );
// ****** END ******************



/**********************************************************/
// PAGE TAKEOVER 2.0
/**********************************************************/

// get the ptko options array
$ptko_settings = get_option('ptko_settings');

// check if page take over is enabled and add display to layout
if( $ptko_settings['ptko_toggle'] === 1 ){
    add_action( 'genesis_before_header', 'display_pto_banner' );
    add_action( 'genesis_before_footer', 'display_pto_banner' );
}

function display_pto_banner(){
    //called where needed to display PTO banner
    $ptko_settings = get_option('ptko_settings');
    if( $ptko_settings['ptko_toggle'] === 1 ){
        ?>
            <div class="takeover" style="background:<?php echo esc_attr($ptko_settings['ptko_bgcolor']);?>">
                <a href="<?php echo esc_url( $ptko_settings['ptko_link'] );?>" target="_blank" rel="nofollow">
                    <img src="<?php echo esc_url( $ptko_settings['ptko_hdrimg'] );?>">
                </a>
            </div>
        <?php
    }
}


/**********************************************************/
// CUSTOMIZE THE FOOTER

remove_action( 'genesis_footer', 'genesis_do_footer' );

function gx_footer() {
    if ( is_page( 'some-page-we-dont-want-this-ftr-on' ) ){
    	//some other footer
		//wp_footer();
    } else {
    ?>
    
    <p class="copyright" data-enhance="false" data-role="none"><?php echo do_shortcode( '[footer_copyright]');?> <a href="/" data-enhance="false" data-role="none">Great Circle Media</a> &middot; All Rights Reserved.
    
    <?php
    }
}
add_action( 'genesis_footer', 'gx_footer' );




/**********************************************************/
// CUSTOM MOBILE MENU

// Add the template
function genexus_mobile_nav() {
    get_template_part( 'templates/mobile-nav' );
}
add_action( 'genesis_before_header', 'genexus_mobile_nav');


// Create the mobile menu 
//$menu_name = 'Mobile Menu';
//$menu_exists = wp_get_nav_menu_object( $menu_name );

//if doesn't exist, create it
//if( ! $menu_exists ){
//    $menu_id = wp_create_nav_menu( $menu_name );

    //set default items
    // Home Page (repeat for other items)
//    wp_update_nav_menu_item( $menu_id, 0, array(
//        'menu-item-title' => __('Home'),
//        'menu-item-classes' => 'home',
//        'menu-item-url' => home_url('/'),
//        'menu-item-status' => 'publish'
//        ));
//}


// Register our mobile menu 
function register_mobile_menu() {
 register_nav_menu('mobile-menu',__( 'Mobile Menu' ));
}
add_action( 'init', 'register_mobile_menu' );


// Get the mobile menu and modify the items output
function modify_mobile_menu(){

    // transient of menu
    //purge('mobile_menu_trans');

    if ( false === ( $mobile_menu_trans = get_transient( 'mobile_menu_trans' ) ) ) {

        // start creating html
        $menu_list = '';
        $menu_list .= '<nav class="js-menu sliding-panel-content">';
        $menu_list .= '<div class="wrap">';
        $menu_list .= '<ul class="menu genesis-nav-menu mobile-menu">';

        // get the menu object and items
        $locations = get_nav_menu_locations();
        $menu = get_term($locations['mobile-menu']);
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        // cycle through items and add arrow
        foreach( $menu_items as $menu_item ){

            //print_r($menu_item);

            if($menu_item->menu_item_parent === '0') {
                $menu_list .= '<li class="menu-item menu-item-has-child">';
            } else {
                $menu_list .= '<li class="menu-item">';
            }

            $menu_list .= '<a href="' . $menu_item->url . '" itemprop="url"><span itemprop="name">' . $menu_item->title . '</span></a>';
            $menu_list .= '</li>';
        }

        // finish building html
        $menu_list .= '</ul>';
        $menu_list .= '</div>';
        $menu_list .= '</nav>';

        $mobile_menu_trans = $menu_list;

        //set transient for 1 day
        set_transient( 'mobile_menu_trans', $mobile_menu_trans, 60*60*24 );

    } else {

        $mobile_menu_trans = get_transient( 'mobile_menu_trans' );

    }

    $menu_list = $mobile_menu_trans;
    //print_r($menu_items);
    echo $menu_list;

}
add_action( 'genesis_before_content_sidebar_wrap', 'modify_mobile_menu', 5 );




/**********************************************************/
// CUSTOMIZE THE Login Screen

// Use your own external URL logo link
function gx_url_login(){
    return "/";
}
add_filter('login_headerurl', 'gx_url_login');

// change logo
function gx_login_logo() {
	?>
    <style type="text/css">
        #login{
            width:500px !important;
        }
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri();?>/images/genexus-logo.png) !important;
            width:500px !important;
            height:100px !important;
            background-size:contain !important;
            background-position:center top !important;
        }
    </style>
    <?php
}
add_action( 'login_head', 'gx_login_logo' );




/**********************************************************/
// ADD USER CONTACT INFO
/*  Add more contact details for WP users in profile */
function gx_user_contactmethods($contactmethods){
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google+';
    return $contactmethods;
}
add_filter('user_contactmethods', 'gx_user_contactmethods', 10, 1);




/**********************************************************/
// PAGINATION
/**
 * Pagination for archive, taxonomy, category, tag and search results pages
 *
 * @global $wp_query http://codex.wordpress.org/Class_Reference/WP_Query
 * @return Prints the HTML for the pagination if a template is $paged
 */
function base_pagination() {
    global $wp_query;

    $big = 999999999; // This needs to be an unlikely integer

    // For more options and info view the docs for paginate_links()
    // http://codex.wordpress.org/Function_Reference/paginate_links
    $paginate_links = paginate_links( array(
        'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages,
        'mid_size' => 5
    ) );

    // Display the pagination if more than one page is found
    if ( $paginate_links ) {
        echo '<div class="pagination">';
        echo $paginate_links;
        echo '</div><!--// end .pagination -->';
    }
}




/**********************************************************/
// FEATURED IMAGE
//Custom fn to display featured image in posts *with* the caption if it has one
 
function featured_image_in_post( ) {
    global $post;
    $thumbnail_id = get_post_thumbnail_id($post->ID);
    $thumbnail_details = get_posts(array('p' => $thumbnail_id, 'post_type' => 'attachment'));
    $thumbnail_src = wp_get_attachment_image_src( $thumbnail_id, 'category-thumb' );
    $thumbnail_width = $thumbnail_src[1];

    if ($thumbnail_src && isset($thumbnail_src[0])) {
        echo '<div class="featured-image">';
        the_post_thumbnail( 'large', array( 'class'=>'img-responsive' ) );
        if ( !empty( $thumbnail_details[0]->post_excerpt ) ) {
            echo '<p class="featured-image-caption">';
            echo $thumbnail_details[0]->post_excerpt;
            echo '</p>';
        }
        echo '</div>';
    }
}




/**********************************************************/
// FUNCTIONS CALLED THROUGHOUT SITE

// Live or Dev (.vag)
//check if  on DEV or LIVE site
function live_or_local(){
    if( strpos( $_SERVER['HTTP_HOST'], '.vag') !== false ){
        //on .vag site
        $liveOrLocal = 'local';
    } else {
        $liveOrLocal = 'live';
    }
    return $liveOrLocal;
}


// Check current category for News
//  dynamically provide either the genexus or kaff news logo based on page
// function check_current_category_for_news(){
//     // Get the news category id by slug
//     $newsCategory = get_category_by_slug('news');
//     $news_cat_id = $newsCategory->term_id;

//     // get child categories of news
//     $cat_args = array('child_of' => $news_cat_id);
//     $news_cat_children = get_categories($cat_args);

//     //get the children cats ids
//     $news_cats = array();
//     $i = 0;
//     foreach($news_cat_children as $news_cat_child){
//         $news_cats[$i] = $news_cat_child->cat_ID;
//         $i += 1;
//     }

//     //add children and parent together in array
//     array_push($news_cats, $news_cat_id);
//     //print_r($news_cats);
//     return($news_cats);
// }

// Convert Object to Array
// Fn to convert Objects of stdClass to Arrays
function object_to_array($object_to_array) {
    if (is_object($object_to_array)) {
        // Gets the properties of the given object
        // with get_object_vars function
        $object_to_array = get_object_vars($object_to_array);
    }
    if (is_array($object_to_array)) {
        /*
        * Return array converted to object
        * Using __FUNCTION__ (Magic constant)
        * for recursive call
        */
        return array_map(__FUNCTION__, $object_to_array);
    } else {
        // Return array
        return $object_to_array;
    }
}

/***************** END FUNCTIONS ************************************


/**********************************************************/
// JETPACK TWEAKS
/* JetPack Publicize custom on/off chosen in Settings/GCMAZ */
// get current user id and compare it against stored id's in our gcmaz_publicize option value
function cust_jetpack_pub_fn(){
	$current_user = wp_get_current_user();
	$gcmaz_settings = get_option( 'gcmaz_settings' );
	if( !in_array( $current_user->ID, $gcmaz_settings['gcmaz_publicize'] ) ){
	    // set auto post to unchecked
	    add_filter( 'publicize_checkbox_default', '__return_false' );
	    //echo "<script> alert('Booo');</script>";
	    //print_r($gcmaz_settings['gcmaz_publicize']);
	}	
}
//add_action( 'after_setup_theme', 'cust_jetpack_pub_fn');


/* remove JetPack sharing buttons from excerpts */
function gcmaz_remove_filters_func() {
     remove_filter( 'the_excerpt', 'sharing_display', 19 );
}
//add_action( 'init', 'gcmaz_remove_filters_func' );



/**********************************************************/
// GRAVITY FORMS
// Gravity Forms Custom Activation Template
// http://gravitywiz.com/customizing-gravity-forms-user-registration-activation-page
function custom_maybe_activate_user() {

    $template_path = STYLESHEETPATH . '/gfur-activate-template/activate.php';
    $is_activate_page = isset( $_GET['page'] ) && $_GET['page'] == 'gf_activation';

    if( ! file_exists( $template_path ) || ! $is_activate_page  )
        return;

    require_once( $template_path );

    exit();
}
add_action('wp', 'custom_maybe_activate_user', 9);



/**********************************************************/
// META SLIDER
// Restrict Meta Slider to admins
function metaslider_permissions($capability) {
    $capability = 'administrator';
    return $capability;
}
add_filter( "metaslider_capability", "metaslider_permissions" );


/**********************************************************/
// BREADCRUMBS
//* Modify breadcrumb arguments.
add_filter( 'genesis_breadcrumb_args', 'sp_breadcrumb_args' );
function sp_breadcrumb_args( $args ) {
    $args['home'] = 'Home';
    $args['sep'] = ' / ';
    $args['list_sep'] = ', '; // Genesis 1.5 and later
    $args['prefix'] = '<div class="breadcrumb">';
    $args['suffix'] = '</div>';
    $args['heirarchial_attachments'] = true; // Genesis 1.5 and later
    $args['heirarchial_categories'] = true; // Genesis 1.5 and later
    $args['display'] = true;
    $args['labels']['prefix'] = '';
    $args['labels']['author'] = 'Archives for ';
    $args['labels']['category'] = 'Archives for '; // Genesis 1.6 and later
    $args['labels']['tag'] = 'Archives for ';
    $args['labels']['date'] = 'Archives for ';
    $args['labels']['search'] = 'Search for ';
    $args['labels']['tax'] = 'Archives for ';
    $args['labels']['post_type'] = 'Archives for ';
    $args['labels']['404'] = 'Not found: '; // Genesis 1.5 and later
return $args;
}