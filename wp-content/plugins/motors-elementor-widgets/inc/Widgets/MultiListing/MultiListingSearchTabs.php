<?php
namespace Motors_E_W\Widgets\MultiListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class MultiListingSearchTabs extends WidgetBase {

	use TextControl;
	use Select2Control;
	use SelectControl;
	use SwitcherControl;
	use ColorControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		wp_register_script(
			'stm-cascadingdropdown',
			get_template_directory_uri() . '/assets/js/jquery.cascadingdropdown.js',
			array( 'jquery' ),
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			'in_footer'
		);

		$this->stm_ew_enqueue(
			$this->get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'elementor-frontend',
				'stmselect2',
				'app-select2',
				'stm-cascadingdropdown',
			)
		);
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_MULTILISTING );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-multilisting-search-tabs';
	}

	public function get_title() {
		return esc_html__( 'MLT Search Tabs', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-listing-search-tabs';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label' => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'type'  => \Elementor\Controls_Manager::TEXT,
			)
		);

		$repeater->add_control(
			'listing_type',
			array(
				'label'   => esc_html__( 'Listing type', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => Helper::stm_ew_multi_listing_types(),
			),
		);

		$repeater->add_control(
			'items_filter_selected',
			array(
				'label'       => esc_html__( 'Select Taxonomies, which will be in this tab as filter', 'motors-elementor-widgets' ),
				'label_block' => true,
				'type'        => \Elementor\Controls_Manager::SELECT2,
				'multiple'    => true,
				'options'     => Helper::stm_ew_multi_listing_search_filter_fields( stm_listings_post_type() ),
				'condition'   => array( 'listing_type' => 'listings' ),
			),
		);

		$listing_types = Helper::stm_ew_multi_listing_types();

		if ( $listing_types ) {
			foreach ( $listing_types as $slug => $typename ) {
				if ( stm_listings_post_type() !== $slug ) {
					$repeater->add_control(
						'items_filter_selected_' . $slug,
						array(
							'label'       => esc_html__( 'Select Taxonomies, which will be in this tab as filter', 'motors-elementor-widgets' ),
							'label_block' => true,
							'type'        => \Elementor\Controls_Manager::SELECT2,
							'multiple'    => true,
							'options'     => Helper::stm_ew_multi_listing_search_filter_fields( $slug ),
							'condition'   => array( 'listing_type' => $slug ),
						),
					);
				}
			}
		}

		$repeater->add_control(
			'button_label',
			array(
				'label'   => esc_html__( 'Search button label', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Search', 'motors-elementor-widgets' ),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'       => esc_html__( 'Items', 'motors-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ item_title }}}',
			)
		);

		$this->stm_ew_add_switcher(
			'show_amount',
			array(
				'label' => esc_html__( 'Show Category Listings amount', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_ew_add_text(
			'select_prefix',
			array(
				'label' => esc_html__( 'Select prefix', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_ew_add_text(
			'select_affix',
			array(
				'label' => esc_html__( 'Select affix', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_ew_add_text(
			'number_prefix',
			array(
				'label' => esc_html__( 'Number prefix', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_ew_add_text(
			'number_affix',
			array(
				'label' => esc_html__( 'Number affix', 'motors-elementor-widgets' ),
			),
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_color', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'active_tab_border_color',
			array(
				'label'     => esc_html__( 'Active Tab Border Top Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.stm_motors_listing_types_multilisting_active {{WRAPPER}} .stm-c-f-search-form-wrap .nav.nav-tabs li a.active' => 'border-top-color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->stm_end_ctrl_tabs();

		$this->stm_start_ctrl_tabs( 'button_style' );

		$this->stm_start_ctrl_tab(
			'btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.stm_motors_listing_types_multilisting_active {{WRAPPER}} .stm-c-f-search-form-wrap .tab-content button[type=submit]' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.stm_motors_listing_types_multilisting_active {{WRAPPER}} .stm-c-f-search-form-wrap .tab-content button[type=submit]' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'btn_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color_hover',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.stm_motors_listing_types_multilisting_active {{WRAPPER}} .stm-c-f-search-form-wrap .tab-content button[type=submit]:hover' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color_hover',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'.stm_motors_listing_types_multilisting_active {{WRAPPER}} .stm-c-f-search-form-wrap .tab-content button[type=submit]:hover' => 'color: {{VALUE}} !important;',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_end_control_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		Helper::stm_ew_load_template( 'widgets/multi-listing/multi-listing-search-tabs', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
