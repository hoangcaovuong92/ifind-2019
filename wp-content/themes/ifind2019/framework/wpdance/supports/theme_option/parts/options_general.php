<?php 
Redux::setSection( $opt_name, array(
    'title'            => __( 'Google API', 'ifind' ),
    'id'               => 'ifind_google_map_api_section',
    'desc'             => __( '', 'ifind' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-map-marker',
    'fields'     => array(
        array(
            'id'       => 'ifind_google_map_api_key',
            'type'     => 'text',
            'title'    => __( 'Google Map API Key', 'ifind' ),
            'subtitle' => __( '', 'ifind' ),
            'desc'     => __( '', 'ifind' ),
            'default'  => $wd_default_data['google_map']['default']['api_key'],
        ),
        array(
            'id'       => 'ifind_google_map_zoom',
            'type'     => 'text',
            'title'    => __( 'Map Zoom', 'ifind' ),
            'subtitle' => __( '', 'ifind' ),
            'desc'     => __( '', 'ifind' ),
            'default'  => $wd_default_data['google_map']['default']['zoom'],
        ),
    ) 
) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Weather API', 'ifind' ),
    'id'               => 'ifind_weather_api_section',
    'desc'             => __( '', 'ifind' ),
    'customizer_width' => '400px',
    'icon'             => 'el el-cloud',
    'fields'     => array(
        array(
            'id'       => 'ifind_weather_api_key',
            'type'     => 'text',
            'title'    => __( 'Openweathermap API Key', 'ifind' ),
            'subtitle' => __( '', 'ifind' ),
            'desc'     => __( '', 'ifind' ),
            'default'  => $wd_default_data['weather']['default']['api_key'],
        ),
        array(
            'id'       => 'ifind_weather_update_time',
            'type'     => 'text',
            'title'    => __( 'Auto Update Time', 'ifind' ),
            'subtitle' => __( '', 'ifind' ),
            'desc'     => __( 'Unit: ms (1000ms = 1s)', 'ifind' ),
            'default'  => $wd_default_data['weather']['default']['update_time'],
        ),
    ) 
) );