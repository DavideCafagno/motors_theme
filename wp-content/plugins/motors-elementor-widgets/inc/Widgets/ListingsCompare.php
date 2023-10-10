<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingsCompare extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use IconsControl;
	use ColorControl;
	use SliderControl;
	use GroupTypographyControl;

	protected $wpcfto_settings = '';

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
		$this->stm_ew_enqueue( 'stm-colored-separator', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-listings-compare';
	}

	public function get_title() {
		return esc_html__( 'Listings Compare', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-inventory-sort';
	}

	public function get_script_depends() {
		return array( 'jquery-effects-slide', $this->get_admin_name() );
	}

	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = self::get_name() . '-rtl';
		$widget_styles[] = self::get_admin_name() . 'jquery-effects-slide';
		$widget_styles[] = self::get_name() . 'stm-colored-separator';

		return $widget_styles;
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'compare_content', __( 'General', 'motors-elementor-widgets' ) );

		if ( stm_is_multilisting() ) {

			$this->stm_ew_add_heading(
				'listing_type_heading',
				array(
					'label'     => esc_html__( 'Default Listing type', 'motors-elementor-widgets' ),
					'separator' => 'before',
				)
			);

		}

		$this->stm_ew_add_text(
			'compare_title',
			array(
				'label'   => __( 'Title', 'motors-elementor-widgets' ),
				'default' => __( 'Compare vehicles', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'add_item_label',
			array(
				'label'   => __( 'Add Item Label', 'motors-elementor-widgets' ),
				'default' => __( 'Add Car To Compare', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'add_item_icon',
			array(
				'label'            => __( 'Add Item Icon', 'motors-elementor-widgets' ),
				'skin'             => 'inline',
				'fa4compatibility' => 'icon',
				'default'          => array(
					'value' => 'stm-icon-add_car',
				),
			)
		);

		if ( stm_is_multilisting() ) {

			$listing_types = Helper::stm_ew_multi_listing_types();

			if ( $listing_types ) {
				foreach ( $listing_types as $slug => $typename ) {
					if ( stm_listings_post_type() !== $slug ) {

						$this->stm_ew_add_heading(
							'listing_type_' . $slug . '_heading',
							array(
								'label'     => esc_html( $typename ),
								'separator' => 'before',
							)
						);

						$this->stm_ew_add_text(
							'compare_title_' . $slug,
							array(
								'label'   => __( 'Title', 'motors-elementor-widgets' ),
								'default' => __( 'Compare vehicles', 'motors-elementor-widgets' ),
							)
						);

						$this->stm_ew_add_text(
							'add_item_label_' . $slug,
							array(
								'label'   => __( 'Add Item Label', 'motors-elementor-widgets' ),
								'default' => __( 'Add Item To Compare', 'motors-elementor-widgets' ),
							)
						);

						$this->stm_ew_add_icons(
							'add_item_icon_' . $slug,
							array(
								'label'            => __( 'Add Item Icon', 'motors-elementor-widgets' ),
								'skin'             => 'inline',
								'fa4compatibility' => 'icon',
								'default'          => array(
									'value' => 'fas fa-plus-circle',
									'library' => 'fa-solid',
								),
							)
						);

					}
				}
			}
		}

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'compare_style', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => __( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 36,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 36,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .car-listing-row.stm-car-compare-row .compare-title',
			)
		);

		$this->stm_ew_add_color(
			'title_line_color',
			array(
				'label'     => __( 'Title Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .colored-separator div' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'add_item_typography',
			array(
				'label'          => __( 'Add Item Label Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 20,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .compare-col-stm-empty .h5',
			)
		);

		$this->stm_ew_add_color(
			'add_item_icon_color',
			array(
				'label'     => __( 'Add Item Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#d1d7dc',
				'selectors' => array(
					'{{WRAPPER}} .stm-icon-add-car-wrapper i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .stm-icon-add-car-wrapper svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'add_item_icon_size',
			array(
				'label'      => __( 'Add Item Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 8,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 52,
				),
				'selectors'  => array(
					'{{WRAPPER}} .compare-col-stm-empty .stm-icon-add-car-wrapper > i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .compare-col-stm-empty .stm-icon-add-car-wrapper > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['add_item_icon'] = $this->stm_ew_get_rendered_icon( 'add_item_icon', $settings );

		if ( stm_is_multilisting() ) {

			$listing_types = Helper::stm_ew_multi_listing_types();

			if ( $listing_types ) {
				foreach ( $listing_types as $slug => $typename ) {
					if ( stm_listings_post_type() !== $slug ) {
						$settings[ 'add_item_icon_' . $slug ] = $this->stm_ew_get_rendered_icon( 'add_item_icon_' . $slug, $settings );
					}
				}
			}
		}

		Helper::stm_ew_load_template( 'widgets/listings-compare', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {

	}
}
