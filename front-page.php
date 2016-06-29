<?php

// Remove page header for front page
//remove_action( 'genesis_header', 'genesis_header_markup_open', 5 );
//remove_action( 'genesis_header', 'genesis_do_header' );
//remove_action( 'genesis_header', 'skm_hdr_title' );
//remove_action( 'genesis_header', 'genesis_header_markup_close', 15 );
//remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
//remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );


// Remove Page Title
//remove_action( 'genesis_post_title', 'genesis_do_post_title' );
//remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

// Content Area
//remove_action( 'genesis_loop', 'genesis_do_loop' );
//add_action( 'genesis_loop', 'page_loop' );



// custom page header
//add_action( 'genesis_before_header', 'gcmaz_pg_hdr' );
function gcmaz_pg_hdr() {
    ?>
        <h1 class="centered">Page Take Over Area</h1>
    <?php
}


function page_loop(){
    ?>

    <div class="row home-top">

        <div class="">
            <?php
                //display home page content
                $home_post_args = array(
                    'post_type' => 'page',
                    'pagename' => 'home',
                );
                $hp_query = new WP_Query( $home_post_args );
                if( $hp_query->have_posts() ){
                    while ( $hp_query->have_posts() ) {
                        $hp_query->the_post();
                        global $post;
                        the_content();
                    }
                }
             ?>
        </div>

    </div>
        
    <?php
}


//add_action('genesis_after_footer', 'add_scripts_to_btm');
function add_scripts_to_btm() {
    ?>
        <script type="text/javascript" src="/wp-content/themes/gcmaz2016/assets/js/dist/main.min.js"></script>
    <?php
}


// genesis child theme
genesis();