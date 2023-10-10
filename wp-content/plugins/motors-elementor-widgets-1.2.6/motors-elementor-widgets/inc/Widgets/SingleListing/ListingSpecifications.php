<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\ChooseControl;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class ListingSpecifications extends WidgetBase {

	use HeadingControl;
	use TextControl;
	use IconsControl;
	use GroupTypographyControl;
	use ColorControl;
	use SelectControl;
	use GroupBorderControl;
	use Select2Control;
	use ChooseControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_admin_register_ss( $this->get_admin_name(), self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		$this->stm_ew_enqueue( self::get_name(), MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION, array( 'jquery' ) );
		if ( is_rtl() ) {
			$this->stm_ew_enqueue( self::get_name() . '-rtl', MOTORS_ELEMENTOR_WIDGETS_PATH, MOTORS_ELEMENTOR_WIDGETS_URL, MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION );
		}
	}
	public function get_style_depends(): array {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = self::get_name() . '-rtl';

		return $widget_styles;
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-specifications';
	}

	public function get_title() {
		return esc_html__( 'Listing Specifications', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-info';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'li_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_choose(
			'specific_columns',
			array(
				'label'   => __( 'Columns', 'motors-elementor-widgets' ),
				'options' => array(
					'one_column' => array(
						'title' => __( 'One Column', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-text-align-justify',
					),
					'two_column' => array(
						'title' => __( 'Two Column', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-columns',
					),
				),
				'default' => 'two_column',
			)
		);

		$this->stm_ew_add_select(
			'li_tag',
			array(
				'label'   => __( 'Group Title Tag', 'motors-elementor-widgets' ),
				'default' => 'h5',
				'options' => array(
					'h1'   => 'H1',
					'h2'   => 'H2',
					'h3'   => 'H3',
					'h4'   => 'H4',
					'h5'   => 'H5',
					'h6'   => 'H6',
					'span' => 'span',
					'div'  => 'div',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'li_style', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'li_typography',
			array(
				'label'          => __( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_transform',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'   => array(
						'default' => array(
							'unit' => 'px',
							'size' => 16,
						),
					),
					'font_weight' => array(
						'default' => '400',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .listing-specifications-wrap .title_wrap .title',
			)
		);

		$this->add_responsive_control(
			'icon_size',
			array(
				'label'           => __( 'Icon Size', 'motors-elementor-widgets' ),
				'type'            => \Elementor\Controls_Manager::SLIDER,
				'range'           => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'desktop_default' => array(
					'size' => 27,
					'unit' => 'px',
				),
				'selectors'       => array(
					'{{WRAPPER}} .listing-specifications-wrap .title_wrap i'   => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .listing-specifications-wrap .title_wrap svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'li_icon_color',
			array(
				'label'     => __( 'Icon Solor', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .listing-specifications-wrap .title_wrap i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .listing-specifications-wrap .title_wrap svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_heading(
			'item_heading',
			array(
				'label' => __( 'Info', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_group_typography(
			'item_title_typography',
			array(
				'label'          => __( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
					'line_height',
				),
				'fields_options' => array(
					'font_size'      => array(
						'default' => array(
							'unit' => 'px',
							'size' => 12,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
					'text_transform' => array(
						'default' => 'uppercase',
					),
				),
				'selector'       => '{{WRAPPER}} .listing-specifications-wrap .item-title',
			)
		);

		$this->stm_ew_add_color(
			'item_title_color',
			array(
				'label'     => __( 'Title Color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .listing-specifications-wrap .item-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'item_desc_typography',
			array(
				'label'          => __( 'Value Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
					'line_height',
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
					'text_transform' => array(
						'default' => 'normal',
					),
				),
				'selector'       => '{{WRAPPER}} .listing-specifications-wrap .item-value',
			)
		);

		$this->stm_ew_add_color(
			'item_desc_color',
			array(
				'label'     => __( 'Value Color', 'motors-elementor-widgets' ),
				'default'   => '#888888',
				'selectors' => array(
					'{{WRAPPER}} .listing-specifications-wrap .item-value' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'item_border',
			array(
				'label'          => __( 'Item Border', 'motors-elementor-widgets' ),
				'fields_options' => array(
					'border' => array(
						'default' => 'solid',
					),
					'width'  => array(
						'default' => array(
							'top'      => '0',
							'right'    => '0',
							'bottom'   => '1',
							'left'     => '0',
							'isLinked' => false,
						),
					),
					'color'  => array(
						'default' => '#d5d9e0',
					),
				),
				'selector'       => '{{WRAPPER}} .listing-specifications-wrap li',
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/single-listing/listing-specifications', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
	}
}
