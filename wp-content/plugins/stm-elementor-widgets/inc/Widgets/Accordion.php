<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class Accordion extends WidgetBase {

	use ColorControl;
	use SelectControl;
	use GroupTypographyControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-accordion';
	}

	public function get_title() {
		return esc_html__( 'Accordion', 'stm-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-accordion';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_select(
			'title_heading',
			array(
				'label'   => __( 'Title Heading', 'stm-elementor-widgets' ),
				'default' => 'h4',
				'options' => array(
					'h1' => __( 'Heading 1', 'stm-elementor-widgets' ),
					'h2' => __( 'Heading 2', 'stm-elementor-widgets' ),
					'h3' => __( 'Heading 3', 'stm-elementor-widgets' ),
					'h4' => __( 'Heading 4', 'stm-elementor-widgets' ),
					'h5' => __( 'Heading 5', 'stm-elementor-widgets' ),
					'h6' => __( 'Heading 6', 'stm-elementor-widgets' ),
				),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'title',
			array(
				'label'       => esc_html__( 'Title', 'stm-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => 'Praesent vitae tortor nunc consectetur',
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'content',
			array(
				'label'      => esc_html__( 'Content', 'stm-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::WYSIWYG,
				'default'    => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
				'show_label' => false,
			)
		);

		$repeater->add_control(
			'icon',
			array(
				'label'   => esc_html__( 'Icon', 'stm-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-quote-left',
					'library' => 'fa-solid',
				),

			)
		);

		$this->add_control(
			'panels',
			array(
				'label'       => esc_html__( 'Accordion Panels', 'stm-elementor-widgets' ),
				'fields'      => $repeater->get_controls(),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'title_field' => '{{{ title }}}',
				'default'     => array(
					array(
						'title'   => 'Vestibulum laoreet eu lorem vel tempor',
						'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'icon'    => array(
							'value'   => 'fas fa-layer-group',
							'library' => 'fa-solid',
						),
					),
					array(
						'title'   => 'Pellentesque non turpis ut est',
						'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'icon'    => array(
							'value'   => 'fas fa-gift',
							'library' => 'fa-solid',
						),
					),
					array(
						'title'   => 'Nam condimentum pellentesque augue',
						'content' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In fringilla, velit id laoreet hendrerit, sapien nisl varius dolor, eu consequat erat augue in eros. Fusce non orci vitae eros porta consequat non at ante. Etiam et ligula quam. In condimentum ex nec sapien luctus pulvinar. Curabitur quis leo quis ex aliquam interdum.</p>',
						'icon'    => array(
							'value'   => 'fas fa-rocket',
							'library' => 'fa-solid',
						),
					),
				),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'icon',
			array(
				'label'     => __( 'Icon Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-accordion .stm-elementor-panels-container .stm-elementor-panel .stm-elementor-panel-heading .stm-elementor-panel-title i.stm-elementor-panel-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_icon',
			array(
				'label'     => __( 'Active Icon Color', 'stm-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-accordion .stm-elementor-panels-container .stm-elementor-panel.active .stm-elementor-panel-heading .stm-elementor-panel-title i.stm-elementor-panel-icon' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'title',
			array(
				'label'     => __( 'Title Color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-panel .panel-title-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'active_title',
			array(
				'label'     => __( 'Active Title Color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-elementor-panel.active .panel-title-text' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_typography', __( 'Typography', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'    => __( 'Title Text Style', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-elementor-panel .stm-elementor-panel-heading .panel-title-text',
			)
		);

		$this->stm_ew_add_group_typography(
			'content_typography',
			array(
				'label'    => __( 'Content Text Style', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-elementor-panel .stm-elementor-panel-body .panel-content-wrap',
				'exclude'  => array(
					'font_style',
					'text_decoration',
				),
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/accordion', STM_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {
		?>
		<# if ( settings.panels ) { #>
		<div class="stm-elementor-accordion">
			<div class="stm-elementor-accordion-container">
				<div class="stm-elementor-panels-container">
					<# _.each( settings.panels, function( item, index ) { #>
						<div class="stm-elementor-panel <# if ( index == 0 ) { 'active' } #>">
							<div class="stm-elementor-panel-heading" data-heading="panel-{{ index }}">
								<{{ settings.title_heading }} class="stm-elementor-panel-title">
									<# if ( item.icon && item.icon.value ) { #>
										<# if ( item.icon.library == 'svg' && item.icon.value.url ) { #>
											<img src="{{ item.icon.value.url }}" class="stm-accordion-svg-icon">
										<# } else { #>
											<i class="stm-elementor-panel-icon {{ item.icon.value }}"></i>
										<# } #>
									<# } #>
									<span class="panel-title-text">
										{{ item.title }}
									</span>
									<i class="stm-elementor-panel-control-icon-chevron fas fa-chevron-down"></i>
								</{{ settings.title_heading }}>
							</div>
							<div class="stm-elementor-panel-body" data-content="panel-{{ index }}" <# if ( index == 0 ) { #> style="display: block;" <# } #>>
								<div class="stm-elementor-panel-content">
									<div class="panel-content-wrap">
										{{{ item.content }}}
									</div>
								</div>
							</div>
						</div>
					<# }) #>
				</div>
			</div>
		</div>
		<# } #>
		<?php
	}
}
