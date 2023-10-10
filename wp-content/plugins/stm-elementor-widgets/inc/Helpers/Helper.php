<?php

namespace STM_E_W\Helpers;

class Helper {
	public static function stm_ew_log( $message ) {
		error_log( $message . PHP_EOL, 3, STM_ELEMENTOR_WIDGETS_PATH . '/error.log' );
	}

	public static function stm_ew_get_selected_layout() {
		return get_option( 'stm_motors_chosen_template', 'car_dealer' );
	}

	/**
	 *
	 * @param string|array $templates Single or array of template files
	 *
	 * @return string
	 */
	public static function stm_ew_locate_template( $templates, $plugin_path = STM_ELEMENTOR_WIDGETS_PATH ) {
		$located = false;

		foreach ( (array) $templates as $template ) {
			if ( substr( $template, - 4 ) !== '.php' ) {
				$template .= '.php';
			}

			$located = locate_template( 'templates/' . $template );

			if ( ! $located ) {
				$located = $plugin_path . '/templates/' . $template;
			}

			if ( file_exists( $located ) ) {
				break;
			}
		}

		return apply_filters( 'stm_ew_locate_template', $located, $templates );
	}

	/**
	 * Load template
	 *
	 * @param $__template
	 * @param array      $__vars
	 */
	public static function stm_ew_load_template( $__template, $plugin_path = STM_ELEMENTOR_WIDGETS_PATH, $__vars = array() ) {
		global $listing_id, $wpdb;
		extract( $__vars ); // phpcs:ignore WordPress.PHP.DontExtract.extract_extract

		if ( ( 'listing_template' === get_post_type( get_the_ID() ) ) ) {
			$listing_row = $wpdb->get_results( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_status='publish' AND post_type='listings' ORDER BY ID ASC LIMIT 1 OFFSET 0" );
			$listing_id  = $listing_row[0]->ID;
		}

		include self::stm_ew_locate_template( $__template, $plugin_path );
	}

	public static function stm_ew_get_image_sizes( $include_default = false ) {
		$sizes = array();

		if ( $include_default ) {
			$sizes = array(
				'thumbnail' => __( 'Thumbnail', 'stm-elementor-widgets' ),
				'medium'    => __( 'Medium', 'stm-elementor-widgets' ),
				'large'     => __( 'Large', 'stm-elementor-widgets' ),
				'full'      => __( 'Full', 'stm-elementor-widgets' ),
			);
		}

		$custom_sizes = wp_get_additional_image_sizes();
		if ( ! empty( $custom_sizes ) ) {
			foreach ( $custom_sizes as $name => $data ) {
				// if starts with 'stm-img' and does NOT end in '-x-2'.
				if ( 'stm-img' === substr( $name, 0, 7 ) && '-x-2' !== substr( $name, -4, 4 ) ) {
					$sizes[ $name ] = $name;
				}
			}
		}

		return $sizes;
	}


	public static function stm_ew_get_multilisting_types( $include_default = false ) {
		$listing_types = array();

		if ( $include_default ) {
			$listing_types = array(
				'listings' => __( 'Listings (default)', 'stm-elementor-widgets' ),
			);
		}

		if ( is_plugin_active( 'motors-listing-types/motors-listing-types.php' ) ) {
			$options = get_option( 'stm_motors_listing_types' );

			if ( isset( $options['multilisting_repeater'] ) && ! empty( $options['multilisting_repeater'] ) ) {
				foreach ( $options['multilisting_repeater'] as $key => $listing ) {
					$listing_types[ $listing['slug'] ] = $listing['label'];
				}
			}
		}

		return $listing_types;
	}

	public static function stm_ew_resize_image( $attach_id, $img_url, $width, $height, $crop = true ) {
		// this is an attachment, so we have the ID.
		$image_src = array();
		if ( $attach_id ) {
			$image_src        = wp_get_attachment_image_src( $attach_id, 'full' );
			$actual_file_path = get_attached_file( $attach_id );
			// this is not an attachment, let's use the image url.
		} elseif ( $img_url ) {
			$file_path        = wp_parse_url( $img_url );
			$actual_file_path = rtrim( ABSPATH, '/' ) . $file_path['path'];
			$orig_size        = getimagesize( $actual_file_path );
			$image_src[0]     = $img_url;
			$image_src[1]     = $orig_size[0];
			$image_src[2]     = $orig_size[1];
		}
		if ( ! empty( $actual_file_path ) ) {
			$file_info = pathinfo( $actual_file_path );
			$extension = '.' . $file_info['extension'];

			// the image path without the extension.
			$no_ext_path = $file_info['dirname'] . '/' . $file_info['filename'];

			$cropped_img_path = $no_ext_path . '-' . $width . 'x' . $height . $extension;

			// checking if the file size is larger than the target size.
			// if it is smaller or the same size, stop right here and return.
			if ( $image_src[1] > $width || $image_src[2] > $height ) {

				// the file is larger, check if the resized version already exists (for $crop = true but will also work for $crop = false if the sizes match).
				if ( file_exists( $cropped_img_path ) ) {
					$cropped_img_url = str_replace( basename( $image_src[0] ), basename( $cropped_img_path ), $image_src[0] );
					$vt_image        = array( $cropped_img_url, $width, $height, false );

					return $vt_image;
				}

				if ( ! $crop ) {
					// calculate the size proportionaly.
					$proportional_size = wp_constrain_dimensions( $image_src[1], $image_src[2], $width, $height );
					$resized_img_path  = $no_ext_path . '-' . $proportional_size[0] . 'x' . $proportional_size[1] . $extension;

					// checking if the file already exists.
					if ( file_exists( $resized_img_path ) ) {
						$resized_img_url = str_replace( basename( $image_src[0] ), basename( $resized_img_path ), $image_src[0] );

						$vt_image = array( $resized_img_url, $proportional_size[0], $proportional_size[1], false );

						return $vt_image;
					}
				}

				// no cache files - let's finally resize it.
				$img_editor = wp_get_image_editor( $actual_file_path );

				if ( is_wp_error( $img_editor ) || is_wp_error( $img_editor->resize( $width, $height, $crop ) ) ) {
					return array( null, null, null, false );
				}

				$new_img_path = $img_editor->generate_filename();

				if ( is_wp_error( $img_editor->save( $new_img_path ) ) ) {
					return array( null, null, null, false );
				}
				if ( ! is_string( $new_img_path ) ) {
					return array( null, null, null, false );
				}

				$new_img_size = getimagesize( $new_img_path );
				$new_img      = str_replace( basename( $image_src[0] ), basename( $new_img_path ), $image_src[0] );

				// resized output.
				$vt_image = array( $new_img, $new_img_size[0], $new_img_size[1], true );

				return $vt_image;
			}

			// default output - without resizing.
			$vt_image = array( $image_src[0], $image_src[1], $image_src[2], false );

			return $vt_image;
		}

		return false;
	}

	public static function stm_ew_get_cf7_select() {
		$response = array();

		if ( ! defined( 'WPCF7_VERSION' ) ) {
			return $response;
		}

		$forms = get_posts(
			array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
			)
		);

		if ( ! empty( $forms ) ) {
			foreach ( $forms as $form ) {
				$response[ $form->ID ] = $form->post_title;
			}
		}

		return $response;
	}
}
