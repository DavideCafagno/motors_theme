<?php

namespace STM_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Widgets\Controls\ContentControls\IconsControl;
use STM_E_W\Widgets\Controls\ContentControls\NumberControl;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\StyleControls\AlignControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\Controls\StyleControls\GroupTypographyControl;
use STM_E_W\Widgets\Controls\StyleControls\SliderControl;
use STM_E_W\Widgets\Controls\StyleControls\VerticalAlignControl;

class IconCounter extends WidgetBase {

	use TextControl;
	use ColorControl;
	use IconsControl;
	use SwitcherControl;
	use SelectControl;
	use AlignControl;
	use NumberControl;
	use VerticalAlignControl;
	use SliderControl;
	use GroupTypographyControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue(
			self::get_name(),
			MOTORS_ELEMENTOR_WIDGETS_PATH,
			MOTORS_ELEMENTOR_WIDGETS_URL,
			MOTORS_ELEMENTOR_WIDGETS_PLUGIN_VERSION,
			array( 'elementor-frontend', 'jquery-numerator' )
		);
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-icon-counter';
	}

	public function get_title(): string {
		return esc_html__( 'Icon Counter', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-icon-counter';
	}

	protected function register_controls() {

		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_number(
			'starting_number',
			array(
				'label'   => esc_html__( 'Starting Number', 'motors-elementor-widgets' ),
				'default' => 0,
			)
		);

		$this->stm_ew_add_number(
			'ending_number',
			array(
				'label'   => esc_html__( 'Ending Number', 'motors-elementor-widgets' ),
				'default' => 100,
			)
		);

		$this->stm_ew_add_text(
			'prefix',
			array(
				'label'       => esc_html__( 'Number Prefix', 'motors-elementor-widgets' ),
				'placeholder' => 1,
			)
		);

		$this->stm_ew_add_text(
			'suffix',
			array(
				'label'       => esc_html__( 'Number Suffix', 'motors-elementor-widgets' ),
				'placeholder' => esc_html__( 'Plus', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_number(
			'duration',
			array(
				'label'   => esc_html__( 'Animation Duration', 'motors-elementor-widgets' ),
				'default' => 2000,
			)
		);

		$this->stm_ew_add_switcher(
			'thousand_separator',
			array(
				'label'   => esc_html__( 'Thousand Separator', 'motors-elementor-widgets' ),
				'default' => 'yes',
			)
		);

		$this->stm_ew_add_select(
			'thousand_separator_char',
			array(
				'label'     => esc_html__( 'Separator', 'motors-elementor-widgets' ),
				'condition' => array(
					'thousand_separator' => 'yes',
				),
				'options'   => array(
					''  => 'Default',
					'.' => 'Dot',
					' ' => 'Space',
				),
			)
		);

		$this->stm_ew_add_text(
			'label',
			array(
				'label'   => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'Label Placeholder', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_icons(
			'icon',
			array(
				'label'   => esc_html__( 'Icon', 'motors-elementor-widgets' ),
				'skin'    => 'inline',
				'default' => array(
					'value' => 'fas fa-car',
				),
			)
		);

		$this->stm_ew_add_align_flex(
			'text_align',
			array(
				'{{WRAPPER}} .stm-counter-meta .stm-value-wrapper' => 'justify-content: {{VALUE}};',
				'{{WRAPPER}} .stm-counter-meta .stm-label' => 'justify-content: {{VALUE}};',
			),
			esc_html__( 'Text Alignment', 'motors-elementor-widgets' ),
		);

		$this->stm_ew_add_align(
			'label_align',
			array(
				'{{WRAPPER}} .stm-counter-meta .stm-label' => 'text-align: {{VALUE}};',
			),
			esc_html__( 'Label Alignment', 'motors-elementor-widgets' ),
		);

		$this->stm_ew_add_vertical_align_flex(
			'icon_align',
			array(
				'{{WRAPPER}} .stm-mt-icon-counter-left' => 'align-self: {{VALUE}};',
			),
			esc_html__( 'Icon Alignment', 'motors-elementor-widgets' ),
		);

		$this->stm_ew_add_slider(
			'lines_gap',
			array(
				'label'      => esc_html__( 'Lines Gap', 'motors-elementor-widgets' ),
				'size_units' => array(
					'px',
				),
				'range'      => array(
					'deg' => array(
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					),
				),
				'default'    => array(
					'unit' => 'px',
					'size' => 5,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-counter-meta .stm-value-wrapper' => 'margin-bottom: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->stm_end_control_section();

		/*Start style section*/
		$this->stm_start_style_controls_section( 'section_color', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_color(
			'icon_color',
			array(
				'label'     => esc_html__( 'Icon Color', 'motors-elementor-widgets' ),
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .stm-mt-icon-counter-left' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
					'{{WRAPPER}} .stm-mt-icon-counter-left path' => 'color: {{VALUE}};fill: {{VALUE}};stroke: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'number_color',
			array(
				'label'     => esc_html__( 'Number Color', 'motors-elementor-widgets' ),
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .stm-counter-meta .stm-value-wrapper' => 'color: {{VALUE}}',
				),
			)
		);

		$this->stm_ew_add_color(
			'text_color',
			array(
				'label'     => esc_html__( 'Label Color', 'motors-elementor-widgets' ),
				'default'   => '#000000',
				'selectors' => array(
					'{{WRAPPER}} .stm-counter-meta' => 'color: {{VALUE}}',
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
					'size' => 56,
				),
				'selectors'  => array(
					'{{WRAPPER}} .stm-mt-icon-counter-left > i'   => 'font-size: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .stm-mt-icon-counter-left > svg' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
				),
			)
		);

		$this->stm_ew_add_group_typography(
			'text_typography',
			array(
				'label'          => esc_html__( 'Number', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
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
							'size' => 45,
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
				'selector'       => '{{WRAPPER}} .stm-counter-meta .stm-value-wrapper',
			)
		);

		$this->stm_ew_add_group_typography(
			'label_typography',
			array(
				'label'          => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'exclude'        => array(
					'font_family',
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
				'selector'       => '{{WRAPPER}} .stm-counter-meta .stm-label',
			)
		);

		$this->end_controls_section();
	}

	protected function content_template() {
		?>
		<# var iconHTML = elementor.helpers.renderIcon( view, settings.icon, { 'aria-hidden': true }, 'i' , 'object' ); #>
		<div class="stm-mt-icon-counter"
				data-duration="{{ settings.duration }}"
				data-from-value="{{ settings.starting_number }}" data-to-value="{{ settings.ending_number }}"
				data-ending_number="{{ settings.ending_number }}"
				data-delimiter="{{ settings.thousand_separator ? settings.thousand_separator_char || ',' : '' }}">
			<div class="stm-mt-icon-counter__wrapper">
				<div class="stm-mt-icon-counter-left">
					{{{ iconHTML.value }}}
				</div>
				<div class="stm-counter-meta heading-font">
					<div class="stm-value-wrapper">
						<# if ( settings.prefix ) { #>
						<div class="stm-value-prefix">{{{ settings.prefix }}}</div>
						<# } #>
						<div class="stm-value">{{{ settings.starting_number }}}</div>
						<# if ( settings.suffix ) { #>
						<div class="stm-value-suffix">{{{ settings.suffix }}}</div>
						<# } #>
					</div>
					<# if ( settings.label ) { #>
					<div class="stm-label">{{{ settings.label }}}</div>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$counter_data = array(
			'ending_number'   => $settings['ending_number'],
			'duration'        => $settings['duration'],
			'data-duration'   => $settings['duration'],
			'data-to-value'   => $settings['ending_number'],
			'data-from-value' => $settings['starting_number'],
		);

		$this->add_render_attribute(
			'counter_data',
			$counter_data
		);

		if ( ! empty( $settings['thousand_separator'] ) ) {
			$delimiter = empty( $settings['thousand_separator_char'] ) ? ',' : $settings['thousand_separator_char'];
			$this->add_render_attribute( 'counter_data', 'data-delimiter', $delimiter );
		}

		?>
		<div class="stm-mt-icon-counter" <?php $this->print_render_attribute_string( 'counter_data' ); ?>>
			<div class="stm-mt-icon-counter__wrapper">
				<div class="stm-mt-icon-counter-left">
					<?php echo wp_kses( $this->stm_ew_get_rendered_icon( 'icon', $settings ), apply_filters( 'stm_ew_kses_svg', array() ) ); ?>
				</div>
				<div class="stm-counter-meta heading-font">
					<div class="stm-value-wrapper">
						<?php if ( $settings['prefix'] ) : ?>
							<div class="stm-value-prefix"><?php $this->print_unescaped_setting( 'prefix' ); ?></div>
						<?php endif; ?>
						<div class="stm-value"><?php $this->print_unescaped_setting( 'starting_number' ); ?></div>
						<?php if ( $settings['suffix'] ) : ?>
							<div class="stm-value-suffix"><?php $this->print_unescaped_setting( 'suffix' ); ?></div>
						<?php endif; ?>
					</div>
					<?php if ( $settings['label'] ) : ?>
						<div class="stm-label">
							<?php $this->print_unescaped_setting( 'label' ); ?>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<?php
	}

}
