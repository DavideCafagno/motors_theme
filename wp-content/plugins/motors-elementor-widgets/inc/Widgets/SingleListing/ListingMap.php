<?php

namespace Motors_E_W\Widgets\SingleListing;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\HeadingControl;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\WidgetBase;

class ListingMap extends WidgetBase {

	use SwitcherControl;
	use MediaControl;
	use IconsControl;
	use ColorControl;
	use GroupTypographyControl;
	use SliderControl;
	use HeadingControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue(
			self::get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array(
				'jquery',
				'stm_gmap',
				'elementor-frontend',
			)
		);
	}

	public function get_categories() {
		return array( MotorsApp::WIDGET_CATEGORY_SINGLE );
	}

	public function get_name() {
		return MotorsApp::STM_PREFIX . '-single-listing-map';
	}

	public function get_title() {
		return esc_html__( 'Listing Map', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-google-map';
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'general', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_switcher(
			'show_address',
			array(
				'label'     => __( 'Address', 'motors-elementor-widgets' ),
				'default'   => 'yes',
			)
		);

		$this->stm_ew_add_icons(
			'address_icon',
			array(
				'label'     => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'      => 'inline',
				'default'   => array(
					'library' => 'service_icons',
					'value'   => 'stmservice-icon- stm-service-icon-pin_2',
				),
				'condition' => array(
					'show_address' => 'yes',
				),
			)
		);

		$this->stm_ew_add_media(
			'pin',
			array(
				'label'       => __( 'Pin Image', 'motors-elementor-widgets' ),
				'label_block' => true,
				'description' => __( 'Leave empty to use default pin icon from Google', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_color', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_heading(
			'heading',
			array(
				'label' => esc_html__( 'Address Settings', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-listing-map__address svg' => 'color: {{VALUE}};fill: {{VALUE}};',
					'{{WRAPPER}} .stm-single-listing-map__address i'   => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'text_color',
			array(
				'label'     => esc_html__( 'Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-single-listing-map__address' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_slider(
			'icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-single-listing-map__address > i'   => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-single-listing-map__address > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'text_typography',
			array(
				'label'    => esc_html__( 'Text Typography', 'motors-elementor-widgets' ),
				'exclude'  => array(
					'font_family',
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'selector' => '{{WRAPPER}} .stm-single-listing-map__address',
			)
		);

		$this->stm_end_control_section();

	}

	protected function get_listings_post_types(): array {
		$post_types = array( stm_listings_post_type() );

		if ( class_exists( '\STMMultiListing' ) ) {
			$listings = \STMMultiListing::stm_get_listings();
			if ( ! empty( $listings ) ) {
				foreach ( $listings as $key => $listing ) {
					$post_types[] = $listing['slug'];
				}
			}
		}

		return $post_types;
	}

	protected function get_lat_long_address(): array {

		if ( ! is_singular( $this->get_listings_post_types() ) ) {
			return array(
				'lat'     => '51.477928',
				'long'    => '-0.001545',
				'address' => 'Prime Meridian (Greenwich)',
			);
		}

		$post_id = get_the_ID();

		$address = get_post_meta( $post_id, 'stm_car_location', true );
		$lat     = get_post_meta( $post_id, 'stm_lat_car_admin', true );
		$long    = get_post_meta( $post_id, 'stm_lng_car_admin', true );

		return compact( 'address', 'lat', 'long' );
	}

	protected function get_pin_icon( $settings ): string {
		if ( ! isset( $settings['pin'] ) || empty( $settings['pin']['url'] ) ) {
			return MOTORS_ELEMENTOR_WIDGETS_URL . '/assets/img/stm-map-marker-green.png';
		}

		return $settings['pin']['url'];
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$map_data = array(
			'icon' => $this->get_pin_icon( $settings ),
		);

		$map_data = array_merge( $this->get_lat_long_address(), $map_data );

		foreach ( $map_data as $key => $datum ) {
			$this->add_render_attribute( 'map_data', $key, $datum );
		}
		?>
		<div class="stm-single-listing-map">
			<?php if ( 'yes' === $settings['show_address'] && ! empty( $map_data['address'] ) ) : ?>
				<div class="stm-single-listing-map__address">
					<?php echo wp_kses( $this->stm_ew_get_rendered_icon( 'address_icon', $settings ), apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
					<span class="stm-single-listing-map__address_text">
						<?php echo esc_html( $map_data['address'] ); ?>
					</span>
				</div>
			<?php endif; ?>
			<div class="stm-single-listing-map__element" <?php $this->print_render_attribute_string( 'map_data' ); ?>></div>
		</div>
		<?php
	}

	protected function content_template() {
	}
}
