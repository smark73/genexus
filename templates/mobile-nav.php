
<nav class="js-menu sliding-panel-content">

<?php

    if ( has_nav_menu( 'mobile-menu' ) ) :
    	wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'menu_class' => 'mobile-menu' ) );
    endif;

?>

</nav>
<div class="js-menu-screen sliding-panel-fade-screen"></div>


<?php
// <nav class="js-menu sliding-panel-content">
//  <ul>
//    <li><a href="javascript:void(0)">Item 1</a></li>
//    <li><a href="javascript:void(0)">Item 2</a></li>
//    <li><a href="javascript:void(0)">Item 3</a></li>
//  </ul>
//</nav>
//<div class="js-menu-screen sliding-panel-fade-screen"></div>
?>
