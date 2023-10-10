<?php
$id = get_the_ID();
$history_link = get_post_meta($id, 'history_link', true);
$show_share = stm_me_get_wpcfto_mod('show_share', false);
$show_test_drive = stm_me_get_wpcfto_mod( 'show_test_drive', false );
$stm_car_link_quote = stm_me_get_wpcfto_mod('stm_car_link_quote', '#1471332454395-0e51ff9f-8682');

$show_quote_phone = stm_me_get_wpcfto_mod('show_quote_phone', false);
$car_price_form = get_post_meta(get_the_ID(), 'car_price_form', true);
$show_trade_in = stm_me_get_wpcfto_mod('show_trade_in', false);
$show_calculator = stm_me_get_wpcfto_mod('show_calculator', false);
$show_report = stm_me_get_wpcfto_mod('show_history', false);


$links = array();

if(!empty($stm_car_link_quote)) {
	$links['stm-moto-icon-chat'] = array(
		'link' => $stm_car_link_quote,
		'target' => '_self',
		'text' => esc_html__( 'Request a quote', 'stm_motors_equipment' )
	);
}

if ( $show_test_drive ) {
	$links['stm-moto-icon-helm'] = array(
		'link' => '#test-drive',
		'modal' => 'data-toggle="modal" data-target="#test-drive"',
		'text' => esc_html__( 'Schedule test drive', 'stm_motors_equipment' )
	);
}

if($show_quote_phone && !empty($car_price_form) and $car_price_form == 'on') {
    $links['stm-moto-icon-phone-chat'] = array(
        'link' => '#get-a-call',
        'modal' => 'data-toggle="modal" data-target="#get-car-price"',
        'text' => esc_html__('Quote by Phone', 'stm_motors_equipment')
    );
}

if($show_trade_in) {
    $links['stm-moto-icon-trade'] = array(
        'link' => '#trade-in',
        'modal' => 'data-toggle="modal" data-target="#trade-in"',
        'text' => esc_html__('Trade In', 'stm_motors_equipment')
    );
}

if($show_calculator) {
    $links['stm-moto-icon-cash'] = array(
        'link' => '#calc',
        'modal' => 'data-toggle="modal" data-target="#get-car-calculator"',
        'text' => esc_html__('Сalculate Payment', 'stm_motors_equipment')
    );
}

if($show_share) {
	$links['stm-moto-icon-share'] = array(
		'link' => '#calculator',
		'text' => esc_html__( 'Share this', 'stm_motors_equipment' )
	);
}

if(!empty($history_link) and $show_report) {
	$links['stm-moto-icon-report'] = array(
		'link' => esc_url($history_link),
		'text' => esc_html__( 'History report', 'stm_motors_equipment' )
	);
}

?>


<div class="stm-single-car-links">
	<?php foreach($links as $icon => $link): ?>
		<?php
			$target = '_blank';
			if(!empty($link['target'])) {
				$target = $link['target'];
			}
		?>
		<div class="stm-single-car-link unit-<?php echo esc_attr($icon); ?> heading-font">
			<a href="<?php echo esc_url($link['link']) ?>" target="<?php echo esc_attr($target); ?>" <?php if(!empty($link['modal'])) echo stm_do_lmth($link['modal']); ?>
				<?php if($icon == 'stm-moto-icon-share') echo 'class="stm-share"'; ?>>
				<i class="<?php echo esc_attr($icon) ?>"></i>
				<?php echo esc_html($link['text']); ?>
			</a>
			<?php if($icon == 'stm-moto-icon-share' && function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) && ! get_post_meta( get_the_ID(), 'sharing_disabled', true )): ?>
				<div class="stm-a2a-popup">
					<?php echo do_shortcode('[addtoany url="'.get_the_permalink(get_the_ID()).'" title="'.get_the_title(get_the_ID()).'"]'); ?>
				</div>
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>