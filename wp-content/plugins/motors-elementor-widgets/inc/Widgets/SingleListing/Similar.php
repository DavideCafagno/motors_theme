<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class Similar extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use Select2Control;
	use GroupTypographyControl;
	use GroupBorderControl;
	use DimensionsControl;
	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-similar-listings';
	}

	public function get_title() {
		return esc_html__( 'Similar Listings', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-grid-view';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'similar_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'similar_title',
			array(
				'label'   => __( 'Title', 'motors-elementor-widgets' ),
				'default' => __( 'Similar listing', 'motors-elementor-widgets' ),
			)
		);

		if ( function_exists( 'stm_is_multilisting' ) && stm_is_multilisting() ) {

			$this->stm_ew_add_heading(
				'listing_type_heading',
				array(
					'label'     => esc_html__( 'Default Listing type', 'motors-elementor-widgets' ),
					'separator' => 'before',
				)
			);

		}

		$this->stm_ew_add_select_2(
			'similar_taxonomies',
			array(
				'label'       => __( 'Show Similar By', 'motors-elementor-widgets' ),
				'description' => __( 'Enter slug of listing category', 'motors-elementor-widgets' ),
				'options'     => $this->motors_get_listing_taxonomies(),
				'multiple'    => true,
			)
		);

		if ( function_exists( 'stm_is_multilisting' ) && stm_is_multilisting() ) {

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

						$this->stm_ew_add_select_2(
							'similar_taxonomies_' . $slug,
							array(
								'label'       => __( 'Show Similar By', 'motors-elementor-widgets' ),
								'description' => __( 'Enter slug of listing category', 'motors-elementor-widgets' ),
								'options'     => Helper::stm_ew_multi_listing_search_filter_fields( $slug ),
								'multiple'    => true,
							)
						);

					}
				}
			}
		}

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'similar_start', __( 'Style', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'similar_typography_title',
			array(
				'label'          => __( 'Label Typography', 'motors-elementor-widgets' ),
				'separator'      => 'before',
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
						'default' => '700',
					),
					'line_height'    => array(
						'default' => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .similar-listings .similar-listings-title',
			)
		);

		$this->stm_ew_add_color(
			'features_icon_color',
			array(
				'label'     => __( 'Label Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .similar-listings .similar-listings-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'label_border',
			array(
				'label'          => __( 'Label Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '4',
							'left'     => '0',
							'isLinked' => false,
						),
					),
					'color'  => array(),
				),
				'selector'       => '{{WRAPPER}} .similar-listings .similar-listings-title',
			)
		);

		$this->stm_ew_add_dimensions(
			'label_padding',
			array(
				'label'     => __( 'Label Padding', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '30',
					'right'    => '0',
					'bottom'   => '19',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .similar-listings .similar-listings-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'label_margin',
			array(
				'label'     => __( 'Label Margin', 'motors-elementor-widgets' ),
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '25',
					'left'     => '0',
					'isLinked' => false,
				),
				'selectors' => array(
					'{{WRAPPER}} .similar-listings .similar-listings-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/similar', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}

	private function motors_get_listing_taxonomies() {
		$filters = stm_listings_attributes(
			array(
				'key_by' => 'slug',
			)
		);

		$filter_fields = array();

		foreach ( $filters as $filter ) {
			$filter_fields[ $filter['slug'] ] = $filter['slug'];
		}

		return $filter_fields;
	}
}
