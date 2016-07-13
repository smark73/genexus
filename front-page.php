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



//



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



// genesis child theme
genesis();