<?php

namespace STM_E_W\Widgets;

use STM_E_W\Helpers\Helper;
use STM_E_W\STMApp;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\MediaControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\WidgetBase;

class TeamMember extends WidgetBase {

	use TextControl;
	use ColorControl;
	use MediaControl;
	use GroupTypographyControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_name() {
		return STMApp::STM_PREFIX . '-team-member';
	}

	public function get_title() {
		return esc_html__( 'Team Member', 'motors-elementor-widgets' );
	}

	public function get_icon() {
		return 'stmew-person';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', __( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_media(
			'image',
			array(
				'label' => __( 'Photo', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'image_size',
			array(
				'label'       => __( 'Photo Size', 'motors-elementor-widgets' ),
				'placeholder' => __( '257x170', 'motors-elementor-widgets' ),
				'default'     => '257x170',
				'description' => __( 'Enter photo size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "medium" size.', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'name',
			array(
				'label'   => __( 'Name', 'motors-elementor-widgets' ),
				'default' => 'John Smith',
			)
		);

		$this->stm_ew_add_text(
			'position',
			array(
				'label'   => __( 'Position', 'motors-elementor-widgets' ),
				'default' => 'Marketing manager',
			)
		);

		$this->stm_ew_add_text(
			'email',
			array(
				'label'   => __( 'Email', 'motors-elementor-widgets' ),
				'default' => 'smith@example.com',
			)
		);

		$this->stm_ew_add_text(
			'phone',
			array(
				'label'   => __( 'Phone', 'motors-elementor-widgets' ),
				'default' => '+1-202-555-0112',
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_colors', __( 'Colors', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'email_btn_bg_color',
			array(
				'label'     => __( 'Email Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .image .team-info .email' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'email_btn_text_color',
			array(
				'label'     => __( 'Email Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .image .team-info .email' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'phone_btn_bg_color',
			array(
				'label'     => __( 'Phone Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .image .team-info .phone' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'phone_btn_text_color',
			array(
				'label'     => __( 'Phone Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .image .team-info .phone a' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'phone_icon_color',
			array(
				'label'     => __( 'Phone Icon Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .image .team-info .phone i' => 'color: {{VALUE}}',
					'{{WRAPPER}} .stm-our-team .image .team-info .phone svg' => 'fill: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'name_color',
			array(
				'label'     => __( 'Name Color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .meta .name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'name_hover_color',
			array(
				'label'     => __( 'Name Hover Color', 'stm-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team:hover .meta .name' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'position_color',
			array(
				'label'     => __( 'Position Color', 'stm-elementor-widgets' ),
				'default'   => '#888',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .meta .position' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'position_hover_color',
			array(
				'label'     => __( 'Position Hover Color', 'stm-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team:hover .meta .position' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'meta_background_color',
			array(
				'label'     => __( 'Bottom Background Color', 'stm-elementor-widgets' ),
				'default'   => 'transparent',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team .meta' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'meta_background_hover_color',
			array(
				'label'     => __( 'Bottom Hover Background Color', 'stm-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-our-team:hover .meta' => 'background-color: {{VALUE}}',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_typography', __( 'Typography', 'stm-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'name_typography',
			array(
				'label'    => __( 'Name Text Style', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-our-team .meta .name',
			)
		);

		$this->stm_ew_add_group_typography(
			'position_typography',
			array(
				'label'    => __( 'Position Text Style', 'stm-elementor-widgets' ),
				'selector' => '{{WRAPPER}} .stm-our-team .meta .position',
			)
		);

		$this->stm_end_control_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		Helper::stm_ew_load_template( 'widgets/team-member', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}

	protected function content_template() {}
}
