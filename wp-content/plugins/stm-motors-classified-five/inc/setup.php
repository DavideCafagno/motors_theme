<?php
add_action('init', 'stm_motors_c_f_setup');

function stm_motors_c_f_setup () {
	add_image_size( 'c-f-gallery-big', 815, 475, true );
	add_image_size( 'c-f-gallery-thumb', 141, 82, true );
	add_image_size( 'c-f-gallery-75-75', 75, 75, true );
}