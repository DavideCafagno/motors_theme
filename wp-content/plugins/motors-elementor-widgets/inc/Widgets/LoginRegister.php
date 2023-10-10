<?php

namespace Motors_E_W\Widgets;

use Motors_E_W\MotorsApp;
use STM_E_W\Helpers\Helper;
use STM_E_W\Widgets\Controls\ContentControls\Select2Control;
use STM_E_W\Widgets\Controls\ContentControls\SelectControl;
use STM_E_W\Widgets\Controls\ContentControls\SwitcherControl;
use STM_E_W\Widgets\Controls\ContentControls\TextControl;
use STM_E_W\Widgets\Controls\ContentControls\UrlControl;
use STM_E_W\Widgets\Controls\StyleControls\ColorControl;
use STM_E_W\Widgets\WidgetBase;

class LoginRegister extends WidgetBase {
	use UrlControl;
	use TextControl;
	use ColorControl;
	use Select2Control;
	use SwitcherControl;

	public function __construct( array $data = array(), array $args = null ) {
		parent::__construct( $data, $args );

		$this->stm_ew_enqueue( self::get_name() );
	}

	public function get_categories(): array {
		return array( MotorsApp::WIDGET_CATEGORY_CLASSIFIED );
	}

	public function get_name(): string {
		return MotorsApp::STM_PREFIX . '-login-register';
	}

	public function get_title(): string {
		return esc_html__( 'Login Register', 'motors-elementor-widgets' );
	}

	public function get_icon(): string {
		return 'stmew-login-register';
	}

	public function get_script_depends() {
		return array( 'uniform', 'uniform-init', $this->get_name(), $this->get_admin_name() );
	}

	public function get_style_depends() {
		$widget_styles   = parent::get_style_depends();
		$widget_styles[] = 'uniform';
		$widget_styles[] = 'uniform-init';
		return $widget_styles;
	}

	protected function register_controls() {
		$this->stm_start_content_controls_section( 'section_content', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_ew_add_text(
			'terms_label',
			array(
				'label'   => esc_html__( 'Label', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'I accept the terms of the', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_text(
			'link_text',
			array(
				'label'   => esc_html__( 'Link Name', 'motors-elementor-widgets' ),
				'default' => esc_html__( 'service', 'motors-elementor-widgets' ),
			)
		);

		$stm_me_wpcfto_pages_list = stm_me_wpcfto_pages_list();

		$this->stm_ew_add_select_2(
			'terms_page',
			array(
				'label'     => esc_html__( 'Terms Page', 'motors-elementor-widgets' ),
				'options'   => $stm_me_wpcfto_pages_list,
				'condition' => array(
					'external_link!' => 'yes',
				),
			)
		);

		$this->stm_ew_add_switcher(
			'external_link',
			array(
				'label'     => esc_html__( 'External Link', 'motors-elementor-widgets' ),
			)
		);

		$this->stm_ew_add_url(
			'link_of_terms',
			array(
				'label'     => esc_html__( 'Link', 'motors-elementor-widgets' ),
				'default'   => array(
					'url'         => 'example.com',
					'is_external' => true,
					'nofollow'    => true,
				),
				'condition' => array(
					'external_link' => 'yes',
				),
			)
		);

		$this->stm_end_control_section();

		$this->stm_start_style_controls_section( 'section_style_general', esc_html__( 'General', 'motors-elementor-widgets' ) );

		$this->stm_start_ctrl_tabs( 'btn_style' );

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
					'{{WRAPPER}} form input[type=submit]:not([disabled])' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} form input[type=submit]:not([disabled])' => 'color: {{VALUE}};',
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
			'background_color_hover',
			array(
				'label'     => esc_html__( 'Button Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} form input[type=submit]:hover:not([disabled])' => 'background: {{VALUE}};box-shadow: 0 2px 0 {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'button_text_color_hover',
			array(
				'label'     => esc_html__( 'Button Text Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} form input[type=submit]:hover:not([disabled])' => 'color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_ctrl_tab();

		$this->stm_end_ctrl_tabs();

		$this->stm_ew_add_color(
			'sign_in_text_color',
			array(
				'label'     => esc_html__( 'Sign In Text Color', 'motors-elementor-widgets' ),
				'default'   => '#fff',
				'selectors' => array(
					'{{WRAPPER}} .stm-login-form form' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'sign_in_background_color',
			array(
				'label'     => esc_html__( 'Sign In Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-login-form form' => 'background-color: {{VALUE}};',
				),
			)
		);

		$this->stm_ew_add_color(
			'sign_up_text_color',
			array(
				'label'     => esc_html__( 'Sign Up Text Color', 'motors-elementor-widgets' ),
				'default'   => '#232628',
				'selectors' => array(
					'{{WRAPPER}} .stm-register-form form' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'sign_up_background_color',
			array(
				'label'     => esc_html__( 'Sign Up Background Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-register-form form' => 'background-color: {{VALUE}};',
				),
			)
		);

		if ( $this->is_wsl_active() ) :

			$this->stm_ew_add_color(
				'wsl_background_color',
				array(
					'label'     => esc_html__( 'Social Login Background Color', 'motors-elementor-widgets' ),
					'selectors' => array(
						'{{WRAPPER}} .stm-social-login-wrap' => 'background-color: {{VALUE}};',
					),
					'separator' => 'before',
				)
			);

			$this->stm_ew_add_color(
				'wsl_text_color',
				array(
					'label'     => esc_html__( 'Social Text Color', 'motors-elementor-widgets' ),
					'default'   => '#232628',
					'selectors' => array(
						'{{WRAPPER}} .stm-social-login-wrap' => 'color: {{VALUE}};',
					),
				)
			);

		endif;

		$this->stm_ew_add_color(
			'labels_color',
			array(
				'label'     => esc_html__( 'Labels Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-login-register-form h3' => 'color: {{VALUE}};',
				),
				'separator' => 'before',
			)
		);

		$this->stm_ew_add_color(
			'borders_color',
			array(
				'label'     => esc_html__( 'Borders Color', 'motors-elementor-widgets' ),
				'selectors' => array(
					'{{WRAPPER}} .stm-register-form form' => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .stm-social-login-wrap'  => 'border-color: {{VALUE}};',
					'{{WRAPPER}} .stm-register-form form input:focus' => 'border-color: {{VALUE}};',
				),
			)
		);

		$this->stm_end_control_section();

	}

	protected function is_wsl_active() {
		return defined( 'WORDPRESS_SOCIAL_LOGIN_ABS_PATH' ) || function_exists( '_wsl__' );
	}

	protected function render_social_login() {

		if ( ! $this->is_wsl_active() ) {
			return;
		}

		global $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG;

		$auth_mode             = 'login';
		$redirect_to           = wsl_get_current_url();
		$authenticate_base_url = add_query_arg(
			array(
				'action' => 'wordpress_social_authenticate',
				'mode'   => 'login',
			),
			site_url( 'wp-login.php', 'login_post' )
		);
		$social_icon_set       = get_option( 'wsl_settings_social_icon_set' );
		// wpzoom icons set, is shown by default
		if ( empty( $social_icon_set ) ) {
			$social_icon_set = 'wpzoom/';
		}

		$connect_with_label = _wsl__( get_option( 'wsl_settings_connect_with_label' ), 'wordpress-social-login' );

		// HOOKABLE:
		$connect_with_label = apply_filters( 'wsl_render_auth_widget_alter_connect_with_label', $connect_with_label );

		$assets_base_url = WORDPRESS_SOCIAL_LOGIN_PLUGIN_URL . 'assets/img/32x32/' . $social_icon_set . '/';
		// HOOKABLE:
		$assets_base_url = apply_filters( 'wsl_render_auth_widget_alter_assets_base_url', $assets_base_url );

		?>
		<div class="wp-social-login-widget">

			<div class="wp-social-login-connect-with"><?php echo esc_html( $connect_with_label ); ?></div>

			<div class="wp-social-login-provider-list">
				<?php
				// Widget::Authentication display
				$wsl_settings_use_popup = get_option( 'wsl_settings_use_popup' );

				// if a user is visiting using a mobile device, WSL will fall back to more in page
				$wsl_settings_use_popup = function_exists( 'wp_is_mobile' ) ? wp_is_mobile() ? 2 : $wsl_settings_use_popup : $wsl_settings_use_popup;

				$no_idp_used = true;

				// display provider icons
				foreach ( $WORDPRESS_SOCIAL_LOGIN_PROVIDERS_CONFIG as $item ) {
					$provider_id   = isset( $item['provider_id'] ) ? $item['provider_id'] : '';
					$provider_name = isset( $item['provider_name'] ) ? $item['provider_name'] : '';

					// provider enabled?
					if ( get_option( 'wsl_settings_' . $provider_id . '_enabled' ) ) {
						// restrict the enabled providers list
						if ( isset( $args['enable_providers'] ) ) {
							$enable_providers = explode( '|', $args['enable_providers'] ); // might add a couple of pico seconds

							if ( ! in_array( strtolower( $provider_id ), $enable_providers, true ) ) {
								continue;
							}
						}

						// build authentication url
						$authenticate_url = add_query_arg(
							array(
								'provider'    => $provider_id,
								'redirect_to' => rawurlencode( $redirect_to ),
							),
							$authenticate_base_url
						);

						// http://codex.wordpress.org/Function_Reference/esc_url
						$authenticate_url = esc_url( $authenticate_url );

						// in case, Widget::Authentication display is set to 'popup', then we overwrite 'authenticate_url'
						// > /assets/js/connect.js will take care of the rest
						if ( $wsl_settings_use_popup && 'test' !== $auth_mode ) {
							$authenticate_url = 'javascript:void(0);';
						}

						// HOOKABLE: allow user to rebuilt the auth url
						$authenticate_url = apply_filters( 'wsl_render_auth_widget_alter_authenticate_url', $authenticate_url, $provider_id, $auth_mode, $redirect_to, $wsl_settings_use_popup );

						// HOOKABLE: allow use of other icon sets
						$provider_icon_markup = apply_filters( 'wsl_render_auth_widget_alter_provider_icon_markup', $provider_id, $provider_name, $authenticate_url );

						if ( $provider_icon_markup !== $provider_id ) {
							echo wp_kses_post( $provider_icon_markup );
						} else {
							?>

							<a rel="nofollow" href="<?php echo esc_url( $authenticate_url ); ?>"
									title="<?php echo esc_attr( sprintf( _wsl__( 'Connect with %s', 'wordpress-social-login' ), $provider_name ) ); ?>"
									class="wp-social-login-provider wp-social-login-provider-<?php echo esc_attr( strtolower( $provider_id ) ); ?>"
									data-provider="<?php echo esc_attr( $provider_id ); ?>" role="button">
								<?php
								if ( 'none' === $social_icon_set ) {
									echo wp_kses_post( apply_filters( 'wsl_render_auth_widget_alter_provider_name', $provider_name ) );
								} else {
									?>
									<img alt="<?php echo esc_attr( $provider_name ); ?>"
									src="<?php echo esc_url( $assets_base_url . strtolower( $provider_id ) . '.png' ); ?>"
									aria-hidden="true" /><?php } ?>
							</a>
							<?php
						}

						$no_idp_used = false;
					}
				}

				// no provider enabled?
				if ( $no_idp_used ) {
					?>
					<p style="background-color: #FFFFE0;border:1px solid #E6DB55;padding:5px;">
						<?php _wsl_e( '<strong>WordPress Social Login is not configured yet</strong>.<br />Please navigate to <strong>Settings &gt; WP Social Login</strong> to configure this plugin.<br />For more information, refer to the <a rel="nofollow" href="http://miled.github.io/wordpress-social-login">online user guide</a>.', 'wordpress-social-login' ); ?>
						.
					</p>
					<?php
				}
				?>

			</div>

			<div class="wp-social-login-widget-clearing"></div>

		</div>
		<?php

	}

	protected function terms_page( $settings ): string {

		$terms_page = $settings['terms_label'];
		if ( 'yes' === $settings['external_link'] ) {
			$link_of_terms = $this->stm_ew_parse_url( 'link_of_terms', $settings );
			$link          = '<a ' . $link_of_terms . '>' . $settings['link_text'] . '</a>';
			$terms_page   .= ' ' . $link;

			return $terms_page;
		}

		if ( is_numeric( $settings['terms_page'] ) ) {
			$link_of_terms = get_permalink( (int) $settings['terms_page'] );
			$link          = '<a href="' . $link_of_terms . '" target="_blank">' . $settings['link_text'] . '</a>';
			$terms_page   .= ' ' . $link;
		}

		return $terms_page;

	}

	protected function render() {

		$settings = $this->get_settings_for_display();

		$settings['__link_of_terms__'] = $this->terms_page( $settings );

		ob_start();
		$this->render_social_login();
		$settings['__social_login_html__'] = ob_get_clean();

		Helper::stm_ew_load_template( 'widgets/login_register', MOTORS_ELEMENTOR_WIDGETS_PATH, $settings );

	}

}
