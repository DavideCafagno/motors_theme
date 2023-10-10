<?php
function register_car_rental_info_metabox($manager, $stmDomain)
{
    /*Register sections*/
    $manager->register_section(
        'stm_car_rent_info',
        array(
            'label' => esc_html__('Car Details', $stmDomain),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'cars_qty' => array(
            'type' => 'text',
            'label' => esc_html__( 'Stock quantity', 'stm_motors_car_rental' ),
        ),
        'cars_info' => array(
            'type' => 'text',
            'label' => esc_html__( 'Cars included', 'stm_motors_car_rental' ),
        ),
    );

    if(function_exists('stm_rental_locations')) {
        $locations = stm_rental_locations( true );

        if ( count( $locations ) > 0 ) {
            $officesArray = array();
            /*Add multiselects*/
            foreach ( $locations as $key => $option ) {
                $officesArray[stm_get_wpml_office_parent_id( $option[5] )] = $option[4];
            }

            $fields['stm_rental_office'] = array(
                'type' => 'multiselect',
                'label' => "Offices",
                'choices' => $officesArray,
                'validate' => 'stm_motors_car_rental_multiselect',
            );
        }
    }

    $fields = apply_filters('stm_projects_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_motors_car_rental_no_validate';

        $atts = array(
            'type' => $type,
            'section' => 'stm_car_rent_info',
            'label' => $field_info['label'],
            'attr' => array(
                'class' => 'widefat',
            )
        );

        if(isset($field_info['choices'])) {
            $atts = array(
                'type' => $type,
                'section' => 'stm_car_rent_info',
                'label' => $field_info['label'],
                'choices' => $field_info['choices']
            );
        }

        $manager->register_control(
            $field,
            $atts
        );

        /*Register setting*/
        $manager->register_setting(
            $field,
            array(
                'sanitize_callback' => $validate,
            )
        );
    }
}