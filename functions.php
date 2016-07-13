<?php
/**
 * Functions
 * @package      genexus
 * @author       Stacy Mark <stacy.mark@kaff.com>
 * @copyright    Copyright (c) 2016
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
define( 'CHILD_THEME_VERSION', '2.1.2' );



/**********************************************************/
//* Enqueue Scripts and Styles

//FRONTEND
function genexus_enqueue_reqs() {

	//load the WP included jquery ... into head
	wp_enqueue_script( 'jquery');

	//wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700,900', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	//* Remove default stylesheet
	wp_deregister_style( 'genesis-sample-theme' );

	//* Add compiled stylesheet
	wp_register_style( 'genexus-styles', get_stylesheet_directory_uri() . '/style.css', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'genexus-styles' );

	//wp_enqueue_script( 'genexus-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0', true );
	//$output = array(
	//	'mainMenu' => __( '', 'genesis-sample' ),
	//	'subMenu'  => __( '', 'genesis-sample' ),
	//);
	//wp_localize_script( 'genexus-responsive-menu', 'genesisSampleL10n', $output );

	//* Add compiled JS
	wp_enqueue_script( 'genexus-scripts', get_stylesheet_directory_uri() . '/js/script.min.js', array(), CHILD_THEME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'genexus_enqueue_reqs' );

//BACKEND load scripts, styles, fonts
function genexus_admin_reqs(){
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
add_action( 'admin_enqueue_scripts', 'genexus_admin_reqs');



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


//* Unregister Genesis sidebars
// Remove default sidebar */
remove_action( 'genesis_sidebar', 'genesis_do_sidebar' );
// Remove secondary sidebar */
//unregister_sidebar( 'header-right' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'sidebar-alt' );


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
add_action( 'genesis_meta', 'genexus_meta_info' );
function genexus_meta_info(){
    ?>
    <meta name="author" content="Great Circle Media">
    <meta name="dcterms.dateCopyrighted" content="2015">
    <meta name="dcterms.rights" content="All Rights Reserved">
    <meta name="dcterms.rightsHolder" content="Great Circle Media">
    <?php
}
//add_action('wp_head', 'genexus_meta_info');

//add animate to front page
function genexus_add_to_head(){
    if( is_front_page() ){
        echo "<link type='text/css' rel='stylesheet' href='/wp-content/themes/genexus/assets/styles/animate/animate.min.css'>";
	}
}
//add_action('wp_head', 'genexus_add_to_head');




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
// -- replaced with ours genexus_site_title
remove_action( 'genesis_site_title', 'genesis_seo_site_title' );

// tagline
//remove_action( 'genesis_site_description', 'genesis_seo_site_description');



// change site title (logo) to ours
function genexus_site_title(){
    ?>
        <div class="hdr-nav-logo">
            <a href="/"><img src="<?php echo get_stylesheet_directory_uri();?>/images/gcm-logo-white.png" class="logo"></a>
        </div>
    <?php
}
add_action( 'genesis_site_title', 'genexus_site_title' );





// custom header
function genexus_do_header(){

    global $post;

    ?>
    <div class="our-title-area">

        <?php //===== LOGO ===== ?>
        <div class="hdr-nav-logo">
            <a href="/"><img src="<?php echo get_stylesheet_directory_uri();?>/images/gcm-logo-white.png" class="logo"></a>
        </div>

        <?php //===== ICONS ===== ?>
        <span class="hdr-nav-icons">
            <?php get_template_part( 'templates/hdr-nav-icons' ); ?>
        </span>

    </div>

    <div class="search-wrap">

        <?php //===== SEARCH ===== ?>
        <div class="genexus-search-area search-hide hidden">
            <form class="genexus-search-area-form" itemprop="potentialAction" itemscope="" itemtype="http://schema.org/SearchAction" method="get" action="<?php echo home_url('/'); ?>" role="search">
                <div class="row">
                    <div class="col-xs-8 col-sm-8 col-md-9 col-lg-10 search-left">
                        <meta itemprop="target" content="<?php echo home_url('/'); ?>?s={s}">
                        <input itemprop="query-input" type="search" name="s" placeholder="Search" class="search-field">
                    </div>
                    <div class="col-xs-4 col-sm-4 col-md-3 col-lg-2 search-right">
                        <button type="submit" class="genexus-search-btn">Search</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

    <?php

}
//add_action( 'genesis_header', 'genexus_do_header' );




// CUSTOMIZE genesis_header_right (shows above default stuff in genesis_header_right)
function genexus_header_right(){

    global $post;
    ?>

	<?php //===== HDR NAV ICONS ===== ?>
	<div class="hdr-nav-icons">
	    <?php get_template_part( 'templates/hdr-nav-icons' ); ?>
	</div>


	<?php //===== SEARCH SHOW/HIDE ===== ?>
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
add_action( 'genesis_header_right', 'genexus_header_right' );



//PAGE TAKEOVER
// if enabled, call this function

// if( page_takeover() ) {
//     function page_takeover_hdr() {
//         ?  >
//             <h1 class="centered">Page Take Over Area</h1>
//         < ?  php
//     }
//     add_action( 'genesis_before_header', 'page_takeover_hdr' );
// }



/**********************************************************/
// CUSTOMIZE THE FOOTER
remove_action( 'genesis_footer', 'genesis_do_footer' );

function genexus_footer() {
    if ( ! is_page( 'some-page-we-dont-want-this-fn-on' ) ){
    	get_template_part( 'templates/ftr-main' );
		wp_footer();
    }
}
//add_action( 'genesis_footer', 'genexus_footer' );





/**********************************************************/
// ADD MOBILE NAV SLIDING MENU
function genexus_mobile_nav() {
    get_template_part( 'templates/mobile-nav' );
}
add_action( 'genesis_before_header', 'genexus_mobile_nav');





/**********************************************************/
// CUSTOM MOBILE MENU

// Register our mobile menu 
function register_mobile_menu() {
  register_nav_menu('mobile-menu',__( 'Mobile Menu' ));
}
add_action( 'init', 'register_mobile_menu' );

// Custom Nav Walker for our mobile menu
class mobile_walker_nav_menu extends Walker_Nav_Menu {

    // add classes to ul sub-menus
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // depth dependent classes
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'sub-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
            );
        $class_names = implode( ' ', $classes );

        // build html
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    // add main/sub classes to li's and links
     function start_el(  &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

        // depth dependent classes
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

        // passed classes
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

        // build html
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . ' ' . $class_names . '">';

        // link attributes
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link mobile-nav-item' : 'mobile-nav-top-item' ) . '"';
        
        //add data- attribute to submenu items
        // we enter the data-filter attribute in the WP link item's "url" field since it isn't used normally
        if($depth > 0){
            // cant input a period for the value of the data-filter attr in the WP link item url, so we used a # instead
            // need to replace the # with a .
            $filter_data_val_raw = esc_attr( $item->url );
            $filter_data_val = str_replace('#', '.', $filter_data_val_raw );
            $attributes .= ' data-filter="' . $filter_data_val . '"';
        }

        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        // build html
        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }
}



/**********************************************************/
// CUSTOMIZE THE Login Screen

// Use your own external URL logo link
function genexus_url_login(){
    return "/";
}
add_filter('login_headerurl', 'genexus_url_login');

// change logo
function genexus_login_logo() {
	?>
    <style type="text/css">
        #login{
            width:500px !important;
        }
        .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri();?>/assets/img/all-logos-gcm.png) !important;
            width:500px !important;
            height:100px !important;
            background-size:contain !important;
            background-position:center top !important;
        }
    </style>
    <?php
}
add_action( 'login_head', 'genexus_login_logo' );




/**********************************************************/
// ADD USER CONTACT INFO
/*  Add more contact details for WP users in profile */
function genexus_user_contactmethods($contactmethods){
    $contactmethods['twitter'] = 'Twitter';
    $contactmethods['facebook'] = 'Facebook';
    $contactmethods['googleplus'] = 'Google+';
    return $contactmethods;
}
add_filter('user_contactmethods', 'genexus_user_contactmethods', 10, 1);




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
function check_current_category_for_news(){
    // Get the news category id by slug
    $newsCategory = get_category_by_slug('news');
    $news_cat_id = $newsCategory->term_id;

    // get child categories of news
    $cat_args = array('child_of' => $news_cat_id);
    $news_cat_children = get_categories($cat_args);

    //get the children cats ids
    $news_cats = array();
    $i = 0;
    foreach($news_cat_children as $news_cat_child){
        $news_cats[$i] = $news_cat_child->cat_ID;
        $i += 1;
    }

    //add children and parent together in array
    array_push($news_cats, $news_cat_id);
    //print_r($news_cats);
    return($news_cats);
}

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