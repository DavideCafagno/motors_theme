<?php

add_filter( 'posts_join', 'stm_vehicles_listing_search_join' );
function stm_vehicles_listing_search_join ( $join ) {
    global $pagenow, $wpdb;

    // filter only when performing a search on edit page of listings post type
    if ( is_admin() && 'edit.php' === $pagenow && !empty($_GET['post_type']) && 'listings' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {
        $join .= 'LEFT JOIN ' . $wpdb->postmeta . ' ON ' . $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }
    return $join;
}

add_filter( 'posts_where', 'stm_vehicles_listing_search_where' );
function stm_vehicles_listing_search_where( $where ) {

	global $pagenow, $wpdb;

	// filter only when performing a search on edit page of listings post type
    if ( is_admin() && 'edit.php' === $pagenow && !empty($_GET['post_type']) && 'listings' === $_GET['post_type'] && ! empty( $_GET['s'] ) ) {
		$where = $where . ' GROUP BY ' . $wpdb->prefix . 'posts.ID';

        $where = preg_replace(
            "/\(\s*" . $wpdb->posts . ".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(" . $wpdb->posts . ".post_title LIKE $1) OR (" . $wpdb->postmeta . ".meta_value LIKE $1)", $where );
    }
    return $where;
}