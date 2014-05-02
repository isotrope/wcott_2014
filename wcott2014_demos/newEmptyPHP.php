<?php
function enqueue_masonry() {
    wp_enqueue_script( 'jquery-masonry' );
}

add_action( 'wp_enqueue_scripts', 'enqueue_masonry' ); // wp_enqueue_scripts action hook to link only on the front-end
?>