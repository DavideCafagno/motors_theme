<?php

add_action( 'after_setup_theme', 'stm_motors_events_setup' );
function stm_motors_events_setup(){
	add_image_size( 'm-e-512-288', 512, 288, true );
	add_image_size( 'm-e-255-160', 255, 160, true );
	add_image_size( 'm-e-1110-580', 1110, 580, true );

	register_sidebar( array(
		'name'          => __( 'Event Sidebar', 'motors' ),
		'id'            => 'events_sidebar',
		'description'   => __( 'Event sidebar that appears on the right or left.', 'motors' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-default %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) );

	/*register_nav_menus( array(
		'primary'   => __( 'Top primary menu', 'motors' ),
		'top_bar'   => __( 'Top bar menu', 'motors' ),
		'bottom_menu'   => __( 'Bottom menu', 'motors' ),
	) );

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'motors' ),
		'id'            => 'default',
		'description'   => __( 'Main sidebar that appears on the right or left.', 'motors' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-default %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="widget-title"><h4>',
		'after_title'   => '</h4></div>',
	) );*/

}