<?php
add_action( 'woocommerce_after_edit_attribute_fields', 'stm_mcr_woocommerce_after_edit_attribute_fields' );
add_action( 'woocommerce_after_add_attribute_fields', 'stm_mcr_woocommerce_after_add_attribute_fields' );
add_action('woocommerce_attribute_added', 'stm_mcr_woocommerce_attribute_added', 2, 100);
add_action('woocommerce_attribute_updated', 'stm_mcr_woocommerce_attribute_updated', 3, 100);

add_filter ('woocommerce_breadcrumb_defaults', 'stm_mcr_woocommerce_breadcrumb_defaults');

function stm_mcr_woocommerce_after_edit_attribute_fields()
{

    $attrId = ( !empty( $_GET['edit'] ) ) ? $_GET['edit'] : 0;

    $current_image = get_term_meta( $attrId, 'stm_cr_main_attributes_image', true );
    $showOnCar = get_term_meta( $attrId, 'stm_cr_main_show_on_car', true );
    $default_image_placeholder = STM_MOTORS_CAR_RENTAL_URL . '/assets/img/placeholder.png';
    $default_image = STM_MOTORS_CAR_RENTAL_URL . '/assets/img/placeholder.png';
    if ( !empty( $current_image ) ) {
        $default_image = wp_get_attachment_image_src( $current_image, 'thumbnail' );
        if ( !empty( $default_image[0] ) ) {
            $default_image = $default_image[0];
        }
    }

    ?>
    <table class="form-table">
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="stm_cr_main_attributes_image"><?php esc_html_e( 'Attribute Image' ,'stm_motors_car_rental'); ?></label></th>
            <td>
                <div class="stm-cr-choose-image">
                    <input
                            type="hidden"
                            name="stm_cr_main_attributes_image"
                            id="stm_cr_main_attributes_image"
                            value="<?php echo esc_attr( $current_image ); ?>"
                            size="40"
                            aria-required="true"/>

                    <img class="stm_cr_main_attributes_image_chosen" src="<?php echo esc_url( $default_image ); ?>"/>

                    <input type="button" class="button-primary" value="Choose image"/>
                    <input type="button" class="button-primary-delete" value="Remove image"/>
                </div>
            </td>
            <script type="text/javascript">
                jQuery(function ($) {
                    $(".stm-cr-choose-image .button-primary").click(function () {
                        var custom_uploader = wp.media({
                            title: "Select image",
                            button: {
                                text: "Attach"
                            },
                            multiple: false
                        }).on("select", function () {
                            var attachment = custom_uploader.state().get("selection").first().toJSON();
                            $('#stm_cr_main_attributes_image').val(attachment.id);
                            $('.stm_cr_main_attributes_image_chosen').attr('src', attachment.url);
                        }).open();
                    });

                    $(".stm-cr-choose-image .button-primary-delete").click(function () {
                        $('#stm_cr_main_attributes_image').val('');
                        $('.stm_cr_main_attributes_image_chosen').attr('src', '<?php echo esc_url( $default_image_placeholder ); ?>');
                    })
                });
            </script>
        </tr>
        <tr class="form-field">
            <th scope="row" valign="top"><label
                        for="stm_cr_main_attributes_image"><?php esc_html_e( 'Show on Car Info', 'stm_motors_car_rental' ); ?></label></th>
            <td>
                <div class="stm-cr-show-car-info">
                    <input type="checkbox" name="stm_cr_main_show_on_car" <?php if($showOnCar) echo 'checked'; ?> />
                </div>
            </td>
        </tr>
    </table>
    <?php
}

function stm_mcr_woocommerce_after_add_attribute_fields()
{
    $default_image = STM_MOTORS_CAR_RENTAL_URL . '/assets/img/placeholder.png';
    ?>
    <div class="form-field">
        <label for="stm_cr_main_attributes_image"><?php esc_html_e( 'Attribute Image', 'stm_motors_car_rental' ); ?></label>
        <div class="stm-cr-choose-image">
            <input
                    type="hidden"
                    name="stm_cr_main_attributes_image"
                    id="stm_cr_main_attributes_image"
                    value=""
                    size="40"
                    aria-required="true"/>

            <img class="stm_cr_main_attributes_image_chosen" src="<?php echo esc_url( $default_image ); ?>"/>

            <input type="button" class="button-primary" value="Choose image"/>
        </div>
        <script type="text/javascript">
            jQuery(function ($) {
                $(".stm-cr-choose-image .button-primary").click(function () {
                    var custom_uploader = wp.media({
                        title: "Select image",
                        button: {
                            text: "Attach"
                        },
                        multiple: false
                    }).on("select", function () {
                        var attachment = custom_uploader.state().get("selection").first().toJSON();
                        $('#stm_cr_main_attributes_image').val(attachment.id);
                        $('.stm_cr_main_attributes_image_chosen').attr('src', attachment.url);
                    }).open();
                });
            });
        </script>
    </div>
    <div class="form-field">
        <label for="stm_cr_main_attributes_image"><?php esc_html_e( 'Show on Car Info', 'stm_motors_car_rental' ); ?></label>
        <div class="stm-cr-show-car-info">
            <input type="checkbox" name="stm_cr_main_show_on_car" />
        </div>
    </div>
    <?php
}

function stm_mcr_woocommerce_attribute_added ($id, $data) {
    if(isset($_POST['stm_cr_main_attributes_image'])) {
        update_term_meta($id, 'stm_cr_main_attributes_image', $_POST['stm_cr_main_attributes_image']);
    }

    if(isset($_POST['stm_cr_main_show_on_car'])) {
        update_term_meta($id, 'stm_cr_main_show_on_car', 'yes');
    } else {
        update_term_meta($id, 'stm_cr_main_show_on_car', '');
    }
}

function stm_mcr_woocommerce_attribute_updated ($id, $data, $old_slug) {
    if(isset($_POST['stm_cr_main_attributes_image'])) {
        update_term_meta($id, 'stm_cr_main_attributes_image', $_POST['stm_cr_main_attributes_image']);
    }

    if(isset($_POST['stm_cr_main_show_on_car'])) {
        update_term_meta($id, 'stm_cr_main_show_on_car', 'yes');
    } else {
        update_term_meta($id, 'stm_cr_main_show_on_car', '');
    }
}

function stm_mcr_woocommerce_breadcrumb_defaults ($args) {
    $args['delimiter'] = '<i class="stm-carent-rental-ico-arrow-right"></i>';

    return $args;
}

?>