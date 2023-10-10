<?php


namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\WidgetBase;

class SearchResults extends WidgetBase {

	use HeadingControl;
	use ColorControl;
	use NumberControl;
	use SwitcherControl;
	use SelectControl;

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
		return MotorsApp::STM_PREFIX . '-single-listing-search-results';
	}

	public function get_title() {
		return esc_html__( 'Search results carousel', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-listings-carousel';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'click_drag',
			array(
				'label'       => __( 'Click & Drag', 'motors-elementor-widgets' ),
				'description' => __( 'Accept mouse events like touch events (click and drag to change slides)', 'motors-elementor-widgets' ),
				'default'     => 'yes',
			)
		);

		$this->stm_ew_add_number(
			'transition_speed',
			array(
				'label'       => __( 'Animation Speed', 'motors-elementor-widgets' ),
				'min'         => 100,
				'step'        => 100,
				'default'     => 500,
				'description' => __( 'Speed of slide animation in milliseconds', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select(
			'desktop_items_count',
			array(
				'label'       => __( 'Number of Items on Desktop', 'motors-elementor-widgets' ),
				'description' => __( 'Minimum width: 1024px.', 'motors-elementor-widgets' ),
				'options'     => array(
					'1' => __( '1 item', 'motors-elementor-widgets' ),
					'2' => __( '2 items', 'motors-elementor-widgets' ),
					'3' => __( '3 items', 'motors-elementor-widgets' ),
					'4' => __( '4 items', 'motors-elementor-widgets' ),
					'5' => __( '5 items', 'motors-elementor-widgets' ),
					'6' => __( '6 items', 'motors-elementor-widgets' ),
				),
				'default'     => '4',
				'label_block' => true,
			)
		);

		$this->stm_ew_add_select(
			'tablet_items_count',
			array(
				'label'       => __( 'Number of Items on Tablet', 'motors-elementor-widgets' ),
				'description' => __( 'Minimum width: 768px.', 'motors-elementor-widgets' ),
				'options'     => array(
					'1' => __( '1 item', 'motors-elementor-widgets' ),
					'2' => __( '2 items', 'motors-elementor-widgets' ),
					'3' => __( '3 items', 'motors-elementor-widgets' ),
					'4' => __( '4 items', 'motors-elementor-widgets' ),
					'5' => __( '5 items', 'motors-elementor-widgets' ),
					'6' => __( '6 items', 'motors-elementor-widgets' ),
				),
				'default'     => '3',
				'label_block' => true,
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'top_line_color',
			array(
				'label'     => __( 'Top Line Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap' => 'box-shadow: 0 2px 5px rgba(0, 0, 0, 0.18), inset 0 4px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_listing_border',
			array(
				'label'     => __( 'Active Listing Border Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop.current .image:before' => 'border: 5px solid {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_price_bg',
			array(
				'label'     => __( 'Listing Price Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price, {{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price:before' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_label_price_text',
			array(
				'label'     => __( 'Listing Price Label Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price .label-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_normal_price_text',
			array(
				'label'     => __( 'Listing Normal Price Text Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price .sale-price,
					{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price .normal-price,
					{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price .heading-font' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_regular_price_text',
			array(
				'label'     => __( 'Listing Regular Price Text Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .price.discounted-price .regular-price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'listing_title_text',
			array(
				'label'     => __( 'Listing Title Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .stm-template-front-loop .listing-car-item-meta .car-meta-top .car-title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'inventory_link_color',
			array(
				'label'     => __( 'Inventory Link Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .navigation-controls .back-search-results h4' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'nav_buttons_bg',
			array(
				'label'     => __( 'Navigation Background Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .next-prev-controls > div' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'nav_buttons_icon',
			array(
				'label'     => __( 'Navigation Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#000',
				'selectors' => array(
					'{{WRAPPER}} .motors-elementor-search-results-wrap .next-prev-controls > div i' => 'color: {{VALUE}};',
					'{{WRAPPER}} .motors-elementor-search-results-wrap .next-prev-controls > div svg' => 'fill: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/single-listing/search-results', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
