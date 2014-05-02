<?php

/**
 * Custom Post Type : Book
 */

/**
 * Register the CPT
 */

add_action( 'init', 'book_cpt_init' );
function book_cpt_init() {
    $labels = array(
        'name' => _x( 'Books', 'Post Type General Name', 'wcott2014' ),
        'singular_name' => _x( 'Book', 'Post Type Singular Name', 'wcott2014' ),
        'menu_name' => _x( 'Books', 'Post Type Menu Name', 'wcott2014' ),
        'parent_item_colon' => __( 'Parent Book:', 'wcott2014' ),
        'all_items' => __( 'All Books', 'wcott2014' ),
        'view_item' => __( 'View Books', 'wcott2014' ),
        'add_new_item' => __( 'Add New Book', 'wcott2014' ),
        'add_new' => __( 'Add New', 'wcott2014' ),
        'edit_item' => __( 'Edit Book', 'wcott2014' ),
        'update_item' => __( 'Update Book', 'wcott2014' ),
        'search_items' => __( 'Search Book', 'wcott2014' ),
        'not_found' => __( 'Not found', 'wcott2014' ),
        'not_found_in_trash' => __( 'Not found in Trash', 'wcott2014' ),
    );
    $args = array(
        'label' => __( 'Book', 'wcott2014' ),
        'description' => __( 'Book post type', 'wcott2014' ),
        'labels' => $labels,
        'supports' => array( 'title', 'editor', 'page-attributes', 'revisions', 'thumbnail' ),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'show_in_admin_bar' => true,
        'menu_position' => 20,
        'menu_icon' => 'dashicons-book',
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
    );
    register_post_type( 'book', $args );


add_image_size( 'book-cover', 640);
}






add_filter( 'manage_book_posts_columns', 'books_custom_columns' );
add_action( 'manage_book_posts_custom_column', 'books_custom_columns_content', 5, 2 );

/**
 * Add columns to the All Books edit screen
 */
function books_custom_columns( $defaults ) {
    $defaults['date_published'] = __( 'Date Published', 'wcott2014' );
    $defaults['book_author'] = __( 'Author', 'wcott2014' );
    $defaults['book_author_twitter'] = __( 'Twitter', 'wcott2014' );
    $defaults['book_publisher_url'] = __( 'Publisher URL', 'wcott2014' );
    $defaults['thumbnail'] = __( 'Thumbnail', 'wcott2014' );

    return $defaults;
}

/**
 * Add content to the custom columns to the All Books edit screen
 */
function books_custom_columns_content( $column_name, $post_id ) {
    if ( $column_name == 'date_published' ) {
        // date_published column
        $date_published = get_post_meta( $post_id, '_books_date_published', true );
        echo $date_published;
    }
    if ( $column_name == 'thumbnail' ) {
        if ( has_post_thumbnail( $post_id ) ) {
            the_post_thumbnail( array( 50, 50 ) );
        }
    }
    if ( $column_name == 'book_author' ) {
        $book_author = get_post_meta( $post_id, '_books_author', true );
        echo $book_author;
    }
    if ( $column_name == 'book_author_twitter' ) {
        $book_author_twitter = get_post_meta( $post_id, '_books_author_twitter', true );
        echo $book_author_twitter;
    }
    if ( $column_name == 'book_publisher_url' ) {
        $book_publisher_url= get_post_meta( $post_id, '_books_publisher_url', true );
        echo $book_publisher_url;
    }
}
