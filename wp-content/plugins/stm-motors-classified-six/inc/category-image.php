<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

add_action('listing-category_add_form_fields', 'stm_taxonomy_c_six_add_field', 20);
add_action('listing-category_edit_form_fields', 'stm_taxonomy_c_six_edit_field', 20, 2);
add_action('created_listing-category', 'stm_taxonomy_c_six_icon_save', 20, 2);
add_action('edited_listing-category', 'stm_taxonomy_c_six_icon_save', 20, 2);

/*Add field*/
if (!function_exists('stm_taxonomy_c_six_add_field')) {

    function stm_taxonomy_c_six_add_field($taxonomy)
    {

        $default_image = STM_MOTORS_C_SIX_URL . '/assets/img/plus.svg';

        ?>
        <div class="form-field stm_form_wrapper stm_form_wrapper_icon">
            <label for="stm_taxonomy_c_six_icon"><?php esc_html_e('Category Image');?></label>
            <input type="hidden" name="stm_taxonomy_c_six_icon" />
            <div class="stm_vehicles_listing_icon">
                <div class="icon">
                    <img src="<?php echo $default_image; ?>" class="stm-default-icon_" />
                    <i></i>
                </div>
				<?php if(empty($value)): ?>
                    <div class="stm_change_icon"><?php esc_html_e('Add icon', 'stm_vehicles_listing'); ?></div>
				<?php else: ?>
                    <div class="stm_change_icon"><?php esc_html_e('Change icon', 'stm_vehicles_listing'); ?></div>
				<?php endif; ?>
                <div class="stm_delete_icon"><?php esc_html_e('Delete icon', 'stm_vehicles_listing'); ?></div>
            </div>
        </div>
    <?php
		stm_c_six_get_icons_html();
    }
}

/*Edit field*/
if (!function_exists('stm_taxonomy_c_six_edit_field')) {
	function stm_taxonomy_c_six_edit_field( $tag, $taxonomy ) {

	    $default_image = plugin_dir_url(__FILE__) . '../assets/img/plus.svg';
		$icon = stm_c_six_get_category_icon($tag->term_id);

		?>
        <tr class="form-field">
        <th scope="row" valign="top">
            <label for="stm_taxonomy_c_six_icon"><?php esc_html_e('Category Icon');?></label>
        </th>
            <td class="stm_form_wrapper_icon">
                <input type="hidden" name="stm_taxonomy_c_six_icon" value="<?php echo esc_attr($icon); ?>" />
                <div class="stm_vehicles_listing_icon">
                    <div class="icon">
                        <img src="<?php echo $default_image; ?>" class="stm-default-icon_<?php echo esc_attr($icon) ?>" />
                        <i class="<?php echo esc_attr($icon); ?>"></i>
                    </div>
					<?php if(empty($value)): ?>
                        <div class="stm_change_icon"><?php esc_html_e('Add icon', 'stm_vehicles_listing'); ?></div>
					<?php else: ?>
                        <div class="stm_change_icon"><?php esc_html_e('Change icon', 'stm_vehicles_listing'); ?></div>
					<?php endif; ?>
                    <div class="stm_delete_icon"><?php esc_html_e('Delete icon', 'stm_vehicles_listing'); ?></div>
                </div>
                <?php stm_c_six_get_icons_html(); ?>
            </td>
        </tr>
<?php 
	}
}

/*Save value*/
if (!function_exists('stm_taxonomy_c_six_icon_save')) {
    function stm_taxonomy_c_six_icon_save($term_id, $tt_id)
    {
        if (isset($_POST['stm_taxonomy_c_six_icon'])) {
            update_term_meta($term_id, 'stm_c_six_icon', $_POST['stm_taxonomy_c_six_icon']);
        } else {
			update_term_meta($term_id, 'stm_c_six_icon', '');
        }
    }
}
