<?php
namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class Title extends WidgetBase {

	use HeadingControl;
	use SelectControl;
	use GroupTypographyControl;
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
		return MotorsApp::STM_PREFIX . '-single-listing-title';
	}

	public function get_title() {
		return esc_html__( 'Title', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-letter-t';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'title_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_select(
			'title_tag',
			array(
				'label'   => __( 'Heading Tag', 'motors-elementor-widgets' ),
				'default' => 'h1',
				'options' => array(
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => __( 'Typography', 'motors-elementor-widgets' ),
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
							'size' => 36,
						),
					),
					'font_weight' => array(
						'default' => '700',
					),
					'line_height' => array(
						'default' => array(
							'unit' => 'px',
							'size' => 42,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm_listing_title',
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => __( 'Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm_listing_title' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/title', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
