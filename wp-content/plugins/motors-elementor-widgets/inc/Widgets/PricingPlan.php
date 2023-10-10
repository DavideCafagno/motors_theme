<?php

namespace Motors_E_W\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\UrlControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\DimensionsControl;
use STM_E_W\Widgets\Controls\StyleControls\DividerControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupBorderControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\VerticalAlignControl;
use STM_E_W\Widgets\WidgetBase;

class PricingPlan extends WidgetBase {

	use TextControl;
	use NumberControl;
	use IconsControl;
	use AlignControl;
	use Select2Control;
	use SwitcherControl;
	use UrlControl;
	use GroupTypographyControl;
	use SliderControl;
	use VerticalAlignControl;
	use ColorControl;
	use DividerControl;
	use GroupBorderControl;
	use DimensionsControl;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( $this->get_name() );

	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-pricing-plan';
	}

	public function get_title(): string {
		return esc_html__( 'Pricing Plan', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-pricing-plans';
	}

	protected function register_controls() {

		$this->stm_ew_general_controls();
		$this->stm_ew_style_general_controls();

	}

	protected function stm_ew_general_controls() {

		$this->stm_start_content_controls_section( 'section_general', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'title',
			array(
				'label'       => esc_html__( 'Plan Title', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Title', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'Business ', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'subtitle',
			array(
				'label'       => esc_html__( 'Subtitle', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Subtitle', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'for dealers', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'icon',
			array(
				'label' => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'  => 'inline',
			)
		);

		$this->stm_ew_add_select_2(
			'icon_position',
			array(
				'label'     => esc_html__( 'Icon Position', 'motors-elementor-widgets' ),
				'default'   => 'above_title',
				'options'   => array(
					'left'        => esc_html__( 'Left', 'motors-elementor-widgets' ),
					'above_title' => esc_html__( 'Above Title', 'motors-elementor-widgets' ),
					'right'       => esc_html__( 'Right', 'motors-elementor-widgets' ),
				),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'title_separator',
			array(
				'label'   => esc_html__( 'Title Separator', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_slider(
			'title_separator_height',
			array(
				'label'      => esc_html__( 'Title Separator Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__title .stm-pricing-plan__separator__element' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'title_separator!' => '',
				),
			)
		);

		$this->stm_ew_add_align_simple(
			'text_align',
			array(),
			esc_html__( 'Text Alignment', 'motors-elementor-widgets' ),
			array(
				'default' => 'center',
			)
		);

		$this->stm_ew_add_text(
			'badge_text',
			array(
				'label'       => esc_html__( 'Badge Text', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Badge Text', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'Popular', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_select_2(
			'badge_position',
			array(
				'label'     => esc_html__( 'Badge Position', 'motors-elementor-widgets' ),
				'default'   => 'top_left',
				'options'   => array(
					'top_left'     => esc_html__( 'Top Left', 'motors-elementor-widgets' ),
					'top_right'    => esc_html__( 'Top Right', 'motors-elementor-widgets' ),
					'left_middle'  => esc_html__( 'Left Middle', 'motors-elementor-widgets' ),
					'right_middle' => esc_html__( 'Right Middle', 'motors-elementor-widgets' ),
					'bottom_left'  => esc_html__( 'Bottom Left', 'motors-elementor-widgets' ),
					'bottom_right' => esc_html__( 'Bottom Right', 'motors-elementor-widgets' ),
				),
				'condition' => array(
					'badge_text!' => '',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'price_separator',
			array(
				'label'     => esc_html__( 'Price Separator', 'motors-elementor-widgets' ),
				'default'   => '',
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_slider(
			'price_separator_height',
			array(
				'label'      => esc_html__( 'Price Separator Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 1,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__price .stm-pricing-plan__separator__element' => 'height: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'price_separator!' => '',
				),
			)
		);

		$this->stm_ew_add_text(
			'currency',
			array(
				'label'       => esc_html__( 'Currency', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Currency', 'motors-elementor-widgets' ),
				'default'     => '$',
			)
		);

		$this->stm_ew_add_align_simple(
			'currency_position',
			array(),
			esc_html__( 'Currency Position', 'motors-elementor-widgets' ),
			array(
				'options'   => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-text-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'motors-elementor-widgets' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'condition' => array(
					'currency!' => '',
				),
			)
		);

		$this->stm_ew_add_number(
			'price',
			array(
				'label'       => esc_html__( 'Price', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Price', 'motors-elementor-widgets' ),
				'default'     => 9,
			)
		);

		$this->stm_ew_add_number(
			'discount',
			array(
				'label'       => esc_html__( 'Discount Price', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Discount Price', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'period_text',
			array(
				'label'       => esc_html__( 'Period Text', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Period Text', 'motors-elementor-widgets' ),
				'default'     => esc_html__( '/ month', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'button_text',
			array(
				'label'       => esc_html__( 'Button Text', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Button Text', 'motors-elementor-widgets' ),
				'default'     => esc_html__( 'Get Started', 'motors-elementor-widgets' ),
				'separator'   => 'before',
			)
		);

		$this->stm_ew_add_url(
			'button_link',
			array(
				'label'       => esc_html__( 'Button Link', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Enter Button Link', 'motors-elementor-widgets' ),
				'condition'   => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_ew_add_select_2(
			'button_position',
			array(
				'label'     => esc_html__( 'Button Position', 'motors-elementor-widgets' ),
				'default'   => 'under_price',
				'options'   => array(
					'under_price' => esc_html__( 'Under Price', 'motors-elementor-widgets' ),
					'bottom'      => esc_html__( 'Bottom', 'motors-elementor-widgets' ),
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_ew_add_slider(
			'button_margin_top',
			array(
				'label'      => esc_html__( 'Button Margin Top', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__button' => 'margin-top: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'button_text!'    => '',
					'button_position' => 'under_price',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'display_items',
			array(
				'label' => esc_html__( 'Display Items', 'motors-elementor-widgets' ),
			)
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'item_title',
			array(
				'label'       => esc_html__( 'Title', 'motors-elementor-widgets' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '',
				'placeholder' => esc_html__( 'Enter Title', 'motors-elementor-widgets' ),
				'label_block' => true,
			)
		);

		$repeater->add_control(
			'item_icon',
			array(
				'label'   => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'skin'    => 'inline',
				'default' => array(
					'value'   => 'fas fa-check',
					'library' => 'fa-solid',
				),
			)
		);

		$repeater->add_control(
			'item_icon_size',
			array(
				'label'      => esc_html__( 'Icon Size', 'motors-elementor-widgets' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 35,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .stm-pricing-plan__items__item__icon'       => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .stm-pricing-plan__items__item__icon > i'   => 'width: {{SIZE}}{{UNIT}};font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} {{CURRENT_ITEM}} .stm-pricing-plan__items__item__icon > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$repeater->add_control(
			'item_icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'motors-elementor-widgets' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} {{CURRENT_ITEM}} .stm-pricing-plan__items__item__icon' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} {{CURRENT_ITEM}} .stm-pricing-plan__items__item__icon path' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->add_control(
			'items',
			array(
				'label'         => esc_html__( 'Items', 'motors-elementor-widgets' ),
				'fields'        => $repeater->get_controls(),
				'type'          => \Elementor\Controls_Manager::REPEATER,
				'title_field'   => '{{{ item_title }}}',
				'prevent_empty' => false,
				'default'       => array(
					array(
						'item_title' => esc_html__( '10 active listing quotas', 'motors-elementor-widgets' ),
					),
					array(
						'item_title' => esc_html__( '7 days listing period', 'motors-elementor-widgets' ),
					),
					array(
						'item_title'      => esc_html__( 'Premium Listing Credit', 'motors-elementor-widgets' ),
						'item_icon'       => array(
							'value'   => 'fas fa-minus',
							'library' => 'fa-solid',
						),
						'item_icon_color' => '#000000',
					),
				),
				'condition'     => array(
					'display_items' => 'yes',
				),
			)
		);

		$this->stm_ew_add_align(
			'items_text_align',
			array(
				'{{WRAPPER}} .stm-pricing-plan__items .stm-pricing-plan__items__item .stm-pricing-plan__items__item__text' => 'text-align: {{VALUE}}',
			),
			esc_html__( 'Items Text Alignment', 'motors-elementor-widgets' ),
			array(
				'default' => 'left',
				'condition' => array(
					'display_items' => 'yes',
				),
			)
		);

		$this->stm_ew_add_slider(
			'items_margin_top',
			array(
				'label'      => esc_html__( 'Items Margin Top', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__items' => 'margin-top: {{SIZE}}{{UNIT}}',
				),
				'condition'  => array(
					'display_items'   => 'yes',
					'button_position' => 'bottom',
				),
			)
		);

		$this->stm_end_control_section();

	}

	protected function stm_ew_style_general_controls() {

		$this->stm_start_style_controls_section( 'section_style_header', esc_html__( 'Header', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'title_typography',
			array(
				'label'          => esc_html__( 'Title Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 24,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
				),
				'condition'      => array(
					'title!' => '',
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__header-text__title',
			)
		);

		$this->stm_ew_add_group_typography(
			'subtitle_typography',
			array(
				'label'          => esc_html__( 'Subtitle Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 13,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
				),
				'condition'      => array(
					'subtitle!' => '',
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__header-text__subtitle',
			)
		);

		$this->stm_ew_add_group_typography(
			'badge_typography',
			array(
				'label'          => esc_html__( 'Badge Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 11,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 32,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '600',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__header__badge > span',
				'condition'      => array(
					'badge_text!' => '',
				),
			)
		);

		$this->stm_ew_add_divider( 'header_typography_ends' );

		$this->stm_ew_add_color(
			'badge_color',
			array(
				'label'     => esc_html__( 'Badge Color', 'motors-elementor-widgets' ),
				'default'   => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header__badge > span' => 'color: {{VALUE}};',
				),
				'condition' => array(
					'badge_text!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'badge_background_color',
			array(
				'label'     => esc_html__( 'Badge Background Color', 'motors-elementor-widgets' ),
				'global'    => array(
					'default' => Global_Colors::COLOR_PRIMARY,
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header__badge'        => 'background: {{VALUE}};',
					'{{WRAPPER}} .stm-pricing-plan__header__badge:before' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'badge_text!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'header_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header'                                       => 'background: {{VALUE}};',
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__title' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_start_ctrl_tabs( 'title_style' );

		$this->stm_start_ctrl_tab(
			'title_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'title_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan .stm-pricing-plan__header-text__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'subtitle_color',
			array(
				'label'     => esc_html__( 'Subtitle Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan .stm-pricing-plan__header-text__subtitle' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'title_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'title_hover_color',
			array(
				'label'     => esc_html__( 'Title Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__header-text__title' => 'color: {{VALUE}};',
				),
				'separator' => 'none',
			)
		);

		$this->stm_ew_add_color(
			'subtitle_hover_color',
			array(
				'label'     => esc_html__( 'Subtitle Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__header-text__subtitle' => 'color: {{VALUE}};',
				),
				'separator' => 'after',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_color(
			'title_separator_color',
			array(
				'label'     => esc_html__( 'Title Separator Color', 'motors-elementor-widgets' ),
				'default'   => '#F1F4F8',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__title .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'title_separator!' => '',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'title_separator_hover',
			array(
				'label'      => esc_html__( 'Separator Hover', 'motors-elementor-widgets' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'title_separator',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->stm_ew_add_switcher(
			'title_separator_narrow_effect',
			array(
				'label'     => esc_html__( 'Separator Narrow Effect', 'motors-elementor-widgets' ),
				'condition' => array(
					'title_separator_hover' => 'yes',
					'title_separator!'      => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'title_separator_color_hover',
			array(
				'label'     => esc_html__( 'Separator Title Color Hover', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__separator.stm-pricing-plan__separator__title .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'title_separator'       => 'yes',
					'title_separator_hover' => 'yes',
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
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 48,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon > i'   => 'font-size: {{SIZE}}{{UNIT}};width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon[value]!' => '',
				),
				'separator'  => 'before',
			)
		);

		$this->stm_ew_add_slider(
			'icon_padding',
			array(
				'label'      => esc_html__( 'Icon Padding', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'padding: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'icon[value]!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'color: {{VALUE}};fill: {{VALUE}};',
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon svg path' => 'color: {{VALUE}};fill: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'icon_background',
			array(
				'label'     => esc_html__( 'Icon Background', 'motors-elementor-widgets' ),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'icon_background_color',
			array(
				'label'     => esc_html__( 'Icon Background Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'icon_background' => 'yes',
					'icon[value]!'    => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'icon_border_radius',
			array(
				'label'      => esc_html__( 'Icon Border Radius', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 100,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'border-radius: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'icon_background!' => '',
					'icon[value]!'     => '',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'icon_border',
			array(
				'label'     => esc_html__( 'Icon Border', 'motors-elementor-widgets' ),
				'condition' => array(
					'icon[value]!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'icon_border_color',
			array(
				'label'     => esc_html__( 'Border Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'icon_border' => 'yes',
				),
				'alpha'     => true,
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__header .stm-pricing-plan__header__wrapper__icon' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_slider(
			'icon_border_width',
			array(
				'label'      => esc_html__( 'Icon Border Width', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'border: {{SIZE}}{{UNIT}} solid',
				),
				'condition'  => array(
					'icon_border' => 'yes',
				),
			)
		);

		$this->stm_ew_add_vertical_align_flex(
			'icon_align',
			array(
				'{{WRAPPER}} .stm-pricing-plan__header__wrapper__icon' => 'align-self: {{VALUE}};',
			),
			esc_html__( 'Icon Alignment', 'motors-elementor-widgets' ),
			array(
				'condition' => array(
					'icon[value]!'   => '',
					'icon_position!' => 'above_title',
				),
			)
		);

		$this->end_controls_section();

		$this->stm_start_style_controls_section( 'section_style_price', esc_html__( 'Price', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'price_typography',
			array(
				'label'          => esc_html__( 'Price Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 48,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '600',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__price',
				'condition'      => array(
					'price!' => '',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'currency_typography',
			array(
				'label'          => esc_html__( 'Currency Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 22,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__price > sup',
				'condition'      => array(
					'currency!' => '',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'discount_typography',
			array(
				'label'          => esc_html__( 'Discount Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 24,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '500',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__price__discount',
				'condition'      => array(
					'discount!' => '',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'period_typography',
			array(
				'label'          => esc_html__( 'Period Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 24,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '500',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__period_text',
				'condition'      => array(
					'period_text!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'price_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__price-section'                                => 'background: {{VALUE}};',
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__price' => 'background: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'price_separator_color',
			array(
				'label'     => esc_html__( 'Price Separator Color', 'motors-elementor-widgets' ),
				'default'   => '#F1F4F8',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__price .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'price_separator!' => '',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'price_separator_hover',
			array(
				'label'      => esc_html__( 'Separator Hover', 'motors-elementor-widgets' ),
				'conditions' => array(
					'relation' => 'or',
					'terms'    => array(
						array(
							'name'     => 'price_separator',
							'operator' => '!==',
							'value'    => '',
						),
					),
				),
			)
		);

		$this->stm_ew_add_switcher(
			'price_separator_narrow_effect',
			array(
				'label'     => esc_html__( 'Separator Narrow Effect', 'motors-elementor-widgets' ),
				'condition' => array(
					'price_separator_hover' => 'yes',
					'price_separator'       => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'price_separator_color_hover',
			array(
				'label'     => esc_html__( 'Separator Title Color Hover', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__separator.stm-pricing-plan__separator__price .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
				'condition' => array(
					'price_separator'       => 'yes',
					'price_separator_hover' => 'yes',
				),
				'separator' => 'after',
			)
		);

		$this->stm_ew_add_color(
			'price_typography_color',
			array(
				'label'     => esc_html__( 'Price Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'price!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__price' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'currency_typography_color',
			array(
				'label'     => esc_html__( 'Currency Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'currency!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__price > sup' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'discount_typography_color',
			array(
				'label'     => esc_html__( 'Discount Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'discount!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__price__discount' => 'color: {{VALUE}};-webkit-text-stroke-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'period_typography_color',
			array(
				'label'     => esc_html__( 'Period Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'period_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__period_text' => 'color: {{VALUE}};',
				),
			)
		);

		$this->end_controls_section();

		$this->stm_start_style_controls_section( 'section_style_content', esc_html__( 'Content', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_group_typography(
			'items_typography',
			array(
				'label'          => esc_html__( 'Items Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 15,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 1,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '400',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__items__item .stm-pricing-plan__items__item__text',
				'condition'      => array(
					'display_items' => 'yes',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'button_typography',
			array(
				'label'          => esc_html__( 'Button Typography', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_style',
					'text_decoration',
					'word_spacing',
				),
				'fields_options' => array(
					'font_size'      => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 14,
						),
					),
					'line_height'    => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'em',
							'size' => 3.5,
						),
					),
					'letter_spacing' => array(
						'size_units' => array(
							'px',
							'em',
						),
						'default'    => array(
							'unit' => 'px',
							'size' => 0,
						),
					),
					'font_weight'    => array(
						'default' => '700',
					),
				),
				'selector'       => '{{WRAPPER}} .stm-pricing-plan__button > a',
				'condition'      => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_ew_add_color(
			'plan_background_color',
			array(
				'label'     => esc_html__( 'Background Color', 'motors-elementor-widgets' ),
				'default'   => '#FFF',
				'selectors' => array(
					'{{WRAPPER}} .elementor-widget-container' => 'background: {{VALUE}};',
				),
				'separator'  => 'before',
			)
		);

		$this->stm_ew_add_slider(
			'items_default_icon_size',
			array(
				'label'      => esc_html__( 'Items Default Icon Size', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 35,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 20,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__items__item__icon'       => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-pricing-plan__items__item__icon > i'   => 'width: {{SIZE}}{{UNIT}};font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-pricing-plan__items__item__icon > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
				'condition'  => array(
					'display_items' => 'yes',
				),
			)
		);

		$this->stm_ew_add_color(
			'items_default_icon_color',
			array(
				'label'     => esc_html__( 'Items Default Icon Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'display_items' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__items__item__icon' => 'fill: {{VALUE}};color: {{VALUE}};',
					'{{WRAPPER}} .stm-pricing-plan__items__item__icon svg path' => 'fill: {{VALUE}};color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'items_text_color',
			array(
				'label'     => esc_html__( 'Items Text Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'display_items' => 'yes',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__items__item' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_start_ctrl_tabs(
			'btns_style',
			array(
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_start_ctrl_tab(
			'btn_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_color(
			'button_typography_color',
			array(
				'label'     => esc_html__( 'Button Typography Color', 'motors-elementor-widgets' ),
				'default'   => '#FFF',
				'condition' => array(
					'button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__button > a' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_background_color',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'global'    => array(
					'default' => Global_Colors::COLOR_SECONDARY,
				),
				'condition' => array(
					'button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__button > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'button_border',
			array(
				'label'     => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .stm-pricing-plan__button',
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'button_border_radius',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'{{WRAPPER}} .stm-pricing-plan__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
			'button_typography_color_hover',
			array(
				'label'     => esc_html__( 'Button Typography Color', 'motors-elementor-widgets' ),
				'default'   => '#000',
				'condition' => array(
					'button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__button:hover > a' => 'color: {{VALUE}};',
				),
				'separator' => 'none',
			)
		);

		$this->stm_ew_add_color(
			'button_background_color_hover',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'condition' => array(
					'button_text!' => '',
				),
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__button:hover > a' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_border(
			'button_border_hover',
			array(
				'label'     => esc_html__( 'Button Border', 'motors-elementor-widgets' ),
				'selector'  => '{{WRAPPER}} .stm-pricing-plan__button:hover',
				'default'   => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'condition' => array(
					'button_text!' => '',
				),
			)
		);

		$this->stm_ew_add_dimensions(
			'button_border_radius_hover',
			array(
				'label'       => esc_html__( 'Border Radius', 'motors-elementor-widgets' ),
				'label_block' => true,
				'default'     => array(
					'top'      => '0',
					'right'    => '0',
					'bottom'   => '0',
					'left'     => '0',
					'isLinked' => true,
				),
				'selectors'   => array(
					'{{WRAPPER}} .stm-pricing-plan__button:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
				'separator'   => 'after',
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_start_ctrl_tabs( 'bottom_line_style' );

		$this->stm_start_ctrl_tab(
			'bottom_line_normal',
			array(
				'label' => __( 'Normal', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_slider(
			'bottom_line_separator_height',
			array(
				'label'      => esc_html__( 'Bottom Line Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__bottom_line .stm-pricing-plan__separator__element' => 'height: {{SIZE}}{{UNIT}}',
				),
				'separator'  => 'none',
			)
		);

		$this->stm_ew_add_color(
			'bottom_line_separator_color',
			array(
				'label'     => esc_html__( 'Bottom Line Separator Color', 'motors-elementor-widgets' ),
				'default'   => '#F1F4F8',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan__separator.stm-pricing-plan__separator__bottom_line .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_start_ctrl_tab(
			'bottom_line_hover',
			array(
				'label' => __( 'Hover', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_slider(
			'bottom_line_separator_height_hover',
			array(
				'label'      => esc_html__( 'Bottom Line Height', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'px' => array(
						'min'  => 0,
						'max'  => 10,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 0,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__separator.stm-pricing-plan__separator__bottom_line .stm-pricing-plan__separator__element' => 'height: {{SIZE}}{{UNIT}}',
				),
				'separator'  => 'none',
			)
		);

		$this->stm_ew_add_color(
			'bottom_line_separator_color_hover',
			array(
				'label'     => esc_html__( 'Bottom Line Separator Color', 'motors-elementor-widgets' ),
				'default'   => '#F1F4F8',
				'selectors' => array(
					'{{WRAPPER}} .stm-pricing-plan:hover .stm-pricing-plan__separator.stm-pricing-plan__separator__bottom_line .stm-pricing-plan__separator__element' => 'background: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$settings['__button_link__'] = $this->stm_ew_parse_url( 'button_link', $settings );
		$settings['icon_html']       = $this->stm_ew_get_rendered_icon( 'icon', $settings );

		Helper::stm_ew_load_template( 'widgets/pricing-plan', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );
	}
}
