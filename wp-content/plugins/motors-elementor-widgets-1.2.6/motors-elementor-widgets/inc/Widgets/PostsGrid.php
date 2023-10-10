<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\ImageSizeControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\UrlControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class PostsGrid extends WidgetBase {

	use NumberControl;
	use TextControl;
	use SwitcherControl;
	use MediaControl;
	use UrlControl;
	use ImageSizeControl;
	use SelectControl;
	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-posts-grid';
	}

	public function get_title(): string {
		return esc_html__( 'Posts Grid', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-grid-view';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_number(
			'posts_number',
			array(
				'label'       => esc_html__( 'Number of Posts', 'motors-elementor-widgets' ),
				'min'         => - 1,
				'step'        => 1,
				'default'     => 3,
				'description' => esc_html__( 'Leave empty or input "-1" to show infinite number of posts', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'style',
			array(
				'label'   => esc_html__( 'Style', 'motors-elementor-widgets' ),
				'options' => array(
					'default'      => 'Default',
					'date_labeled' => 'Date labeled',
				),
				'default' => 'default',
			),
		);

		$this->stm_ew_add_switcher(
			'enable_sticky',
			array(
				'label'   => esc_html__( 'Sticky posts', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_switcher(
			'show_advert',
			array(
				'label'   => esc_html__( 'Advertising', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_media(
			'advert_image',
			array(
				'label'     => esc_html__( 'Advertisement Image', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_advert' => 'yes',
				),
			)
		);

		$this->stm_ew_add_image_size(
			'advert_size',
			array(
				'condition' => array(
					'show_advert' => 'yes',
				),
			),
		);

		$this->stm_ew_add_number(
			'position_advert',
			array(
				'label'     => esc_html__( 'Advertising position', 'motors-elementor-widgets' ),
				'min'       => 0,
				'step'      => 1,
				'default'   => 3,
				'condition' => array(
					'show_advert' => 'yes',
				),
			)
		);

		$this->stm_ew_add_url(
			'advert_link',
			array(
				'label'     => esc_html__( 'Advertisement Link', 'motors-elementor-widgets' ),
				'condition' => array(
					'show_advert' => 'yes',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_end_ctrl_tabs();

		$this->stm_start_ctrl_tabs( 'color_style' );

		$this->stm_start_ctrl_tab(
			'btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .posts-grid .post-grid-single-unit h4'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .posts-grid .post-grid-single-unit h4 a' => 'color: {{VALUE}};',
				),
			),
		);

		$this->stm_ew_add_color(
			'excerpt_color',
			array(
				'label'     => esc_html__( 'Excerpt Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .posts-grid .post-grid-single-unit .excerpt' => 'color: {{VALUE}};',
				),
			),
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'btn_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'title_color_hover',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .posts-grid .post-grid-single-unit:hover h4'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .posts-grid .post-grid-single-unit:hover h4 a' => 'color: {{VALUE}};',
				),
			),
		);

		$this->stm_ew_add_color(
			'excerpt_color_hover',
			array(
				'label'     => esc_html__( 'Excerpt Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .posts-grid .post-grid-single-unit:hover .excerpt' => 'color: {{VALUE}};',
				),
			),
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( is_array( $settings['advert_link'] ) && ! empty( $settings['advert_link'] ) ) {
			$this->add_link_attributes( 'advert_link_attrs', $settings['advert_link'] );
			$settings['advert_attrs'] = $this->get_render_attribute_string( 'advert_link_attrs' );
		}

		//needs for advertising ad image
		$settings['_settings_'] = $settings;

		Helper::stm_ew_load_template( 'widgets/posts-grid/posts-grid', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

}
