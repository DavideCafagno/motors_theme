<?php

if ( ! function_exists( 'stm_mcr_shop_page_id' ) ) {
	function stm_mcr_shop_page_id() {
		return apply_filters( 'stm_mcr_shop_page_id', get_option( 'woocommerce_shop_page_id' ) );
	}
}
if ( ! function_exists( 'stm_mcr_shop_page_url' ) ) {
	function stm_mcr_shop_page_url() {
		return apply_filters( 'stm_mcr_shop_page_url', get_permalink( stm_mcr_shop_page_id() ) );
	}
}
if ( ! function_exists( 'stm_mcr_shop_checkout_id' ) ) {
	function stm_mcr_shop_checkout_id() {
		return apply_filters( 'woocommerce_checkout_page_id', get_option( 'woocommerce_checkout_page_id' ) );
	}
}
if ( ! function_exists( 'stm_mcr_shop_checkout_url' ) ) {
	function stm_mcr_shop_checkout_url() {
		return apply_filters( 'stm_mcr_shop_page_url', get_permalink( stm_mcr_shop_checkout_id() ) );
	}
}

if ( ! function_exists( 'stm_mcr_get_product_atts' ) ) {
	function stm_mcr_get_product_atts( $product ) {
		$attributes = $product->get_attributes();

		$product_attributes = array();

		foreach ( $attributes as $attribute ) {

			$values = array();

			if ( $attribute->is_taxonomy() ) {
				$attribute_taxonomy = $attribute->get_taxonomy_object();
				$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

				foreach ( $attribute_values as $attribute_value ) {
					$value_name = esc_html( $attribute_value->name );

					if ( $attribute_taxonomy->attribute_public ) {
						$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
					} else {
						$values[] = $value_name;
					}
				}
			}

			$current_image = get_term_meta( $attribute->get_id(), 'stm_cr_main_attributes_image', true );
			$default_image = '';
			if ( ! empty( $current_image ) ) {
				$default_image = wp_get_attachment_image_src( $current_image, 'thumbnail' );
				if ( ! empty( $default_image[0] ) ) {
					$default_image = $default_image[0];
				}
			}

			$showOnCar = get_term_meta( $attribute->get_id(), 'stm_cr_main_show_on_car', true );

			$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
				'label'   => wc_attribute_label( $attribute->get_name() ),
				'value'   => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
				'img'     => $default_image,
				'show'    => $showOnCar,
				'visible' => ( $attribute->get_visible() ) ? 1 : 0,
			);
		}

		return $product_attributes;
	}
}

function stm_mcr_check_valid_rent_info() {
	$rentInfo = stm_get_rental_order_fields_values();

	if ( empty( $rentInfo['pickup_location'] ) || '--' === $rentInfo['pickup_date'] || '--' === $rentInfo['return_date'] ) {
		return false;
	}

	return true;
}

// Resize image

if ( false === has_filter( 'wp_get_attachment_image_src', 'stm_mcr_get_thumbnail_filter' ) ) {
	add_filter( 'wp_get_attachment_image_src', 'stm_mcr_get_thumbnail_filter', 100, 4 );
	function stm_mcr_get_thumbnail_filter( $image, $attachment_id, $size = 'thumbnail', $icon = false ) {

		$file       = wp_check_filetype( get_attached_file( $attachment_id ) );
		$image_exts = array( 'jpg', 'jpeg', 'jpe', 'png', 'webp' );

		if ( ! in_array( $file['ext'], $image_exts, true ) ) {
			return $image;
		}

		return stm_mcr_get_thumbnail( $attachment_id, $size, $icon = false );
	}
}

function stm_mcr_get_thumbnail( $attachment_id, $size = 'thumbnail', $icon = false ) {
	$intermediate = image_get_intermediate_size( $attachment_id, $size );
	$upload_dir   = wp_upload_dir();

	if ( ! $intermediate || ! file_exists( $upload_dir['basedir'] . '/' . $intermediate['path'] ) ) {
		$file = get_attached_file( $attachment_id );
		if ( ! ( $file ) || ! file_exists( $file ) ) {
			return false;
		}

		$imagesize = getimagesize( $file );

		if ( is_array( $size ) ) {
			$sizes = array(
				'width'  => $size[0],
				'height' => $size[1],
			);
		} else {
			$_wp_additional_image_sizes = wp_get_additional_image_sizes();
			$sizes                      = array();
			foreach ( get_intermediate_image_sizes() as $s ) {
				$sizes[ $s ] = array(
					'width'  => '',
					'height' => '',
					'crop'   => false,
				);

				if ( isset( $_wp_additional_image_sizes[ $s ]['width'] ) ) {
					// For theme-added sizes
					$sizes[ $s ]['width'] = intval( $_wp_additional_image_sizes[ $s ]['width'] );
				} else {
					// For default sizes set in options
					$sizes[ $s ]['width'] = get_option( "{$s}_size_w" );
				}

				if ( isset( $_wp_additional_image_sizes[ $s ]['height'] ) ) {
					// For theme-added sizes
					$sizes[ $s ]['height'] = intval( $_wp_additional_image_sizes[ $s ]['height'] );
				} else {
					// For default sizes set in options
					$sizes[ $s ]['height'] = get_option( "{$s}_size_h" );
				}

				if ( isset( $_wp_additional_image_sizes[ $s ]['crop'] ) ) {
					// For theme-added sizes
					$sizes[ $s ]['crop'] = $_wp_additional_image_sizes[ $s ]['crop'];
				} else {
					// For default sizes set in options
					$sizes[ $s ]['crop'] = get_option( "{$s}_crop" );
				}
			}

			if ( ! is_array( $size ) && ! isset( $sizes[ $size ] ) ) {
				$sizes['width']  = $imagesize[0];
				$sizes['height'] = $imagesize[1];
			} else {
				$sizes = $sizes[ $size ];
			}
		}

		if ( $sizes['width'] >= $imagesize[0] ) {
			$sizes['width'] = null;
		}

		if ( $sizes['height'] >= $imagesize[1] ) {
			$sizes['height'] = null;
		}

		$editor = wp_get_image_editor( $file );
		if ( ! is_wp_error( $editor ) ) {
			$resize                     = $editor->multi_resize( array( $sizes ) );
			$wp_get_attachment_metadata = wp_get_attachment_metadata( $attachment_id );

			if ( isset( $resize[0] ) && is_array( $size ) && isset( $wp_get_attachment_metadata['sizes'] ) ) {
				foreach ( $wp_get_attachment_metadata['sizes'] as $key => $val ) {
					if ( array_search( $resize[0]['file'], $val, true ) ) {
						$size = $key;
					}
				}
			}

			if ( is_array( $size ) ) {
				$size = $size[0] . 'x' . $size[0];
			}

			if ( ! $wp_get_attachment_metadata ) {
				$wp_get_attachment_metadata                   = array();
				$wp_get_attachment_metadata['width']          = $imagesize[0];
				$wp_get_attachment_metadata['height']         = $imagesize[1];
				$wp_get_attachment_metadata['file']           = _wp_relative_upload_path( $file );
				$wp_get_attachment_metadata['sizes'][ $size ] = $resize[0];
			} else {
				if ( isset( $resize[0] ) ) {
					$wp_get_attachment_metadata['sizes'][ $size ] = $resize[0];
				}
			}
			wp_update_attachment_metadata( $attachment_id, $wp_get_attachment_metadata );
		}
	}
	$image = image_downsize( $attachment_id, $size );

	return apply_filters( 'get_thumbnail', $image, $attachment_id, $size, $icon );
}

function stm_mcr_rent_a_car_form_shortcode( $atts ) {
	$atts = shortcode_atts(
		array(
			'title'  => esc_html__( 'Find your car', 'stm_motors_car_rental' ),
			'workhr' => '9-19',
		),
		$atts
	);

	ob_start();
	stm_car_rental_load_template(
		'parts/booking-form-shortcode',
		array(
			'title'  => $atts['title'],
			'workHr' => $atts['workhr'],
			'css'    => '',
		)
	);

	return ob_get_clean();
}

add_shortcode( 'stm_rent_a_car_form', 'stm_mcr_rent_a_car_form_shortcode' );

if ( ! function_exists( 'stm_mcr_is_front_page' ) ) {
	function stm_mcr_is_front_page() {
		$home = get_option( 'page_on_front', '' );

		$isFront = false;
		if ( $home && get_the_ID() === $home ) {
			$isFront = true;
		}

		$isFront = apply_filters( 'stm_mcr_is_front_page', $isFront );

		return $isFront;
	}
}
