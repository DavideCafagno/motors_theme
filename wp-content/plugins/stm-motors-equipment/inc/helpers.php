<?php
// Resize image

if ( false === has_filter( 'wp_get_attachment_image_src', 'stm_equip_get_thumbnail_filter' ) ) {
	add_filter( 'wp_get_attachment_image_src', 'stm_equip_get_thumbnail_filter', 100, 4 );
	function stm_equip_get_thumbnail_filter( $image, $attachment_id, $size = 'thumbnail', $icon = false ) {
		$file       = wp_check_filetype( get_attached_file( $attachment_id ) );
		$image_exts = array( 'jpg', 'jpeg', 'jpe', 'png', 'webp' );

		if ( ! in_array( $file['ext'], $image_exts, true ) ) {
			return $image;
		}

		return stm_equip_get_thumbnail( $attachment_id, $size, $icon = false );
	}
}

function stm_equip_get_thumbnail( $attachment_id, $size = 'thumbnail', $icon = false ) {
	$intermediate = image_get_intermediate_size( $attachment_id, $size );
	$upload_dir   = wp_upload_dir();

	if ( ! $intermediate || ! file_exists( $upload_dir['basedir'] . '/' . $intermediate['path'] ) ) {
		$file = get_attached_file( $attachment_id );
		if ( empty( $file ) || ! file_exists( $file ) ) {
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
				if ( ! empty( $imagesize[0] ) && ! empty( $imagesize[1] ) ) {
					$sizes['width']  = $imagesize[0];
					$sizes['height'] = $imagesize[1];
				}
			} else {
				$sizes = $sizes[ $size ];
			}
		}

		if ( empty( $sizes['width'] ) || $sizes['width'] >= $imagesize[0] ) {
			$sizes['width'] = null;
		}

		if ( empty( $sizes['height'] ) || $sizes['height'] >= $imagesize[1] ) {
			$sizes['height'] = null;
		}

		$editor = wp_get_image_editor( $file );
		if ( ! is_wp_error( $editor ) ) {
			$resize                     = $editor->multi_resize( array( $sizes ) );
			$wp_get_attachment_metadata = wp_get_attachment_metadata( $attachment_id );

			if ( isset( $resize[0] ) && is_array( $size ) && isset( $wp_get_attachment_metadata['sizes'] ) ) {
				foreach ( $wp_get_attachment_metadata['sizes'] as $key => $val ) {
					if ( array_search( $resize[0]['file'], $val ) ) {
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
