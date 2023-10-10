<?php
add_action('init', 'stm_motors_c_six_setup');

function stm_motors_c_six_setup()
{
	add_image_size( 'c-f-gallery-big', 815, 475, true );
	add_image_size( 'c-f-gallery-thumb', 141, 82, true );
	add_image_size( 'c-f-gallery-75-75', 75, 75, true );
	add_image_size( 'c-f-gallery-398-696', 398, 696, true );
	add_image_size( '398-696', 398, 696, true );
	add_image_size( '330-205', 330, 205, true );
}