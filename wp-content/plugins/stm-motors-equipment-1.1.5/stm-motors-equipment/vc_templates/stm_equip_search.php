<?php

stm_equipment_module_enqueue_scripts_styles( 'stm_equip_search' );

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );//phpcs:ignore

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css, ' ' ) );

$show_sold = stm_me_get_wpcfto_mod( 'show_sold_listings', false );

?>
	<div class="stm_equip_listing_filter filter-listing stm-vc-ajax-filter animated fadeIn <?php echo esc_attr( $css_class ); ?>">

		<!-- Tab panes -->
		<div class="container">
			<div class="form-wrap">
				<form action="<?php echo esc_url( stm_get_listing_archive_link() ); ?>" method="GET">
					<div class="stm-filter-tab-selects filter stm-vc-ajax-filter">
						<?php stm_listing_filter_get_selects( $filter_all, '', '', '', false, $show_sold ); ?>
						<?php if ( isset( $_GET['posts_per_page'] ) ) : //phpcs:ignore?>
							<input type="hidden" name="posts_per_page" value="<?php echo esc_attr( $_GET['posts_per_page'] ); //phpcs:ignore?>"/>
						<?php endif; ?>
					</div>
					<div class="btn-wrap">
						<button type="submit" class="heading-font">
							<?php echo esc_html__( 'Search', 'stm_motors_equipment' ); ?>
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
<?php
$bind_tax = stm_data_binding( true );

if ( ! empty( $bind_tax ) ) :
	// @codingStandardsIgnoreStart
	?>
	<script>
        jQuery(function ($) {
            var options = <?php echo json_encode( $bind_tax ); ?>,
                show_amount = <?php echo json_encode( $show_amount != 'no' ) ?>;

            if (show_amount) {
                $.each(options, function (tax, data) {
                    $.each(data.options, function (val, option) {
                        option.label += ' (' + option.count + ')';
                    });
                });
            }

            $('.stm-filter-tab-selects.filter').each(function () {
                new STMCascadingSelect(this, options);
            });

            $("select[data-class='stm_select_overflowed']").on("change", function () {
                var sel = $(this);
                var selValue = sel.val();
                var selType = sel.attr("data-sel-type");
                var min = 'min_' + selType;
                var max = 'max_' + selType;

                if (selValue === null || selValue.length == 0) return;

                if (selValue.includes("<")) {
                    var str = selValue.replace("<", "").trim();
                    $("input[name='" + min + "']").val("");
                    $("input[name='" + max + "']").val(str);
                } else if (selValue.includes("-")) {
                    var strSplit = selValue.split("-");
                    $("input[name='" + min + "']").val(strSplit[0]);
                    $("input[name='" + max + "']").val(strSplit[1]);
                } else {
                    var str = selValue.replace(">", "").trim();
                    $("input[name='" + min + "']").val(str);
                    $("input[name='" + max + "']").val("");
                }
            });
        });
	</script>
<?php
// @codingStandardsIgnoreEnd
endif;
?>
