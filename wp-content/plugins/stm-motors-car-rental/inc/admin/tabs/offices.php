<?php
function register_car_rental_metabox($manager, $stmDomain)
{
    /*Register sections*/
    $manager->register_section(
        'stm_office_details',
        array(
            'label' => esc_html__('Office Info', $stmDomain),
            'icon' => 'fa fa-bookmark'
        )
    );

    /*Register controls*/
    $fields = array(
        'address' => array(
            'type' => 'text',
            'label' => esc_html__( 'Office address', 'stm_motors_car_rental' ),
        ),
        'latitude' => array(
            'type' => 'text',
            'label' => esc_html__( 'Office latitude', 'stm_motors_car_rental' ),
            'description' => esc_html__( 'You can find latitude on http://www.latlong.net/', 'stm_motors_car_rental' ),
        ),
        'longitude' => array(
            'type' => 'text',
            'label' => esc_html__( 'Office longitude', 'stm_motors_car_rental' ),
            'description' => esc_html__( 'You can find longitude on http://www.latlong.net/', 'stm_motors_car_rental' ),
        ),
        'phone' => array(
            'type' => 'text',
            'label' => esc_html__( 'Phone', 'stm_motors_car_rental' ),
        ),
        'fax' => array(
            'type' => 'text',
            'label' => esc_html__( 'Fax', 'stm_motors_car_rental' ),
        ),
        'work_hours' => array(
            'type' => 'text',
            'label' => esc_html__( 'Work hours', 'stm_motors_car_rental' ),
        ),
    );

    $fields = apply_filters('stm_projects_fields', $fields);

    foreach($fields as $field => $field_info) {
        /*Register control*/
        $type = (!empty($field_info['type'])) ? $field_info['type'] : 'text';
        $validate = (!empty($field_info['validate'])) ? $field_info['validate'] : 'stm_motors_car_rental_no_validate';
        $manager->register_control(
            $field,
            array(
                'type' => $type,
                'section' => 'stm_office_details',
                'label' => $field_info['label'],
                'attr' => array(
                    'class' => 'widefat',
                )
            )
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