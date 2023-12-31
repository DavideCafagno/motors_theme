<?php

add_action( 'init', 'stm_motors_events_init', 1 );

function stm_motors_events_init() {

	$options = get_option( 'stm_post_types_options' );

	$stm_events_options = array(
		'stm_events' => array(
			'title'        => ( ! empty( $options['stm_events']['title'] ) ) ? $options['stm_events']['title'] : __( 'Events', 'stm_motors_events' ),
			'plural_title' => ( ! empty( $options['stm_events']['plural_title'] ) ) ? $options['stm_events']['plural_title'] : __( 'Events', 'stm_motors_events' ),
			'rewrite'      => ( ! empty( $options['stm_events']['rewrite'] ) ) ? $options['stm_events']['rewrite'] : 'stm_events',
			'sub_types'    => array(
				array(
					'slug'     => 'stm_participants',
					'name'     => esc_html__( 'Participant', 'stm_motors_events' ),
					'plural'   => esc_html__( 'Participants', 'stm_motors_events' ),
					'supports' => array( 'title' ),
				),
				array(
					'slug'     => 'stm_speakers',
					'name'     => esc_html__( 'Speaker', 'stm_motors_events' ),
					'plural'   => esc_html__( 'Speakers', 'stm_motors_events' ),
					'supports' => array( 'title', 'thumbnail' ),
				),
			),
		),
	);

	register_post_type(
		'stm_events',
		array(
			'labels'             => array(
				'name'               => $stm_events_options['stm_events']['plural_title'],
				'singular_name'      => $stm_events_options['stm_events']['title'],
				'add_new'            => __( 'Add New', 'stm_motors_events' ),
				'add_new_item'       => __( 'Add New Item', 'stm_motors_events' ),
				'edit_item'          => __( 'Edit Item', 'stm_motors_events' ),
				'new_item'           => __( 'New Item', 'stm_motors_events' ),
				'all_items'          => __( 'All Items', 'stm_motors_events' ),
				'view_item'          => __( 'View Item', 'stm_motors_events' ),
				'search_items'       => __( 'Search Items', 'stm_motors_events' ),
				'not_found'          => __( 'No items found', 'stm_motors_events' ),
				'not_found_in_trash' => __( 'No items found in Trash', 'stm_motors_events' ),
				'parent_item_colon'  => '',
				'menu_name'          => __( $stm_events_options['stm_events']['plural_title'], 'stm_motors_events' ),//phpcs:ignore
			),
			'menu_icon'          => 'dashicons-location-alt',
			'show_in_nav_menus'  => true,
			'supports'           => array( 'title', 'editor', 'thumbnail', 'comments', 'excerpt', 'author' ),
			'rewrite'            => array( 'slug' => $stm_events_options['stm_events']['rewrite'] ),
			'has_archive'        => true,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'         => array( 'event_tag' ),
		)
	);

	foreach ( $stm_events_options['stm_events']['sub_types'] as $args ) {
		$sub_type   = $args;
		$sub_labels = post_type_labels( $sub_type['name'], $sub_type['plural'] );

		$sub_args = array(
			'labels'             => $sub_labels,
			'public'             => false,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => 'edit.php?post_type=stm_events',
			'query_var'          => false,
			'rewrite'            => array( 'slug' => $sub_type['slug'] ),
			'capability_type'    => 'post',
			'has_archive'        => false,
			'hierarchical'       => false,
			'supports'           => $sub_type['supports'],
		);

		register_post_type( $sub_type['slug'], $sub_args );
	}

	stm_events_register_taxonomies( 'event_category', 'Event category', 'stm_events' );

	stm_events_tag_taxonomies();
}

function stm_events_register_taxonomies( $slug, $taxonomyName, $post_type ) {
	$pluralName = $taxonomyName . 's';

	//phpcs:disable
	$labels = array(
		'name'              => _x( $taxonomyName, 'taxonomy general name', 'stm_motors_events' ),
		'singular_name'     => _x( $taxonomyName, 'taxonomy singular name', 'stm_motors_events' ),
		'search_items'      => __( 'Search ' . $pluralName, 'stm_motors_events' ),
		'all_items'         => __( 'All ' . $pluralName, 'stm_motors_events' ),
		'parent_item'       => __( 'Parent ' . $taxonomyName, 'stm_motors_events' ),
		'parent_item_colon' => __( 'Parent ' . $taxonomyName . ':', 'stm_motors_events' ),
		'edit_item'         => __( 'Edit ' . $taxonomyName, 'stm_motors_events' ),
		'update_item'       => __( 'Update ' . $taxonomyName, 'stm_motors_events' ),
		'add_new_item'      => __( 'Add New ' . $taxonomyName, 'stm_motors_events' ),
		'new_item_name'     => __( 'New ' . $taxonomyName . 'Name', 'stm_motors_events' ),
		'menu_name'         => __( $taxonomyName, 'stm_motors_events' ),
	);
	//phpcs:enable

	$defaults = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_in_nav_menus' => false,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => $slug ),
	);

	register_taxonomy( $slug, $post_type, $defaults );
}

function stm_events_tag_taxonomies() {
	$labels = array(
		'name'                       => _x( 'Event Tags', 'taxonomy general name' ),
		'singular_name'              => _x( 'Event Tag', 'taxonomy singular name' ),
		'search_items'               => __( 'Search Tags' ),
		'popular_items'              => __( 'Popular Tags' ),
		'all_items'                  => __( 'All Tags' ),
		'parent_item'                => null,
		'parent_item_colon'          => null,
		'edit_item'                  => __( 'Edit Tag' ),
		'update_item'                => __( 'Update Tag' ),
		'add_new_item'               => __( 'Add New Tag' ),
		'new_item_name'              => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
		'add_or_remove_items'        => __( 'Add or remove tags' ),
		'choose_from_most_used'      => __( 'Choose from the most used tags' ),
		'menu_name'                  => __( 'Tags' ),
	);

	register_taxonomy(
		'event_tag',
		'stm_events',
		array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'event_tag' ),
		)
	);
}

function post_type_labels( $name, $plural ) {
	$name   = sanitize_text_field( $name );
	$plural = sanitize_text_field( $plural );
	$labels = array(
		'name'               => sprintf( __( '%s', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'singular_name'      => sprintf( __( '%s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'menu_name'          => sprintf( __( '%s', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'name_admin_bar'     => sprintf( __( '%s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'add_new'            => __( 'Add New', 'stm_motors_events' ),//phpcs:ignore
		'add_new_item'       => sprintf( __( 'Add new %s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'new_item'           => sprintf( __( 'New %s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'edit_item'          => sprintf( __( 'Edit %s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'view_item'          => sprintf( __( 'View %s', 'stm_motors_events' ), $name ),//phpcs:ignore
		'all_items'          => sprintf( __( 'All %s', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'search_items'       => sprintf( __( 'Search %s', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'parent_item_colon'  => sprintf( __( 'Parent %s', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'not_found'          => sprintf( __( 'No %s found', 'stm_motors_events' ), $plural ),//phpcs:ignore
		'not_found_in_trash' => sprintf( __( 'No %s found in Trash.', 'stm_motors_events' ), $plural ),//phpcs:ignore
	);

	return apply_filters( 'stm_motors_events_post_type_labels', $labels );
}
