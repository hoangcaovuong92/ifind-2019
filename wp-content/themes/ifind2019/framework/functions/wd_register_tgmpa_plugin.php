<?php
if(!function_exists ('wd_register_tgmpa_plugin')){
    function wd_register_tgmpa_plugin(){
        $wd_plugins = array(
            array(
                'name'                  => esc_html__('ACF Pro', 'feellio'), // The plugin name
                'desc'                  => '', // The plugin description
                'slug'                  => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name)
                'source'                => WD_THEME_PLUGIN . '/advanced-custom-fields-pro.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__('Gravity Form', 'feellio'), // The plugin name
                'desc'                  => '', // The plugin description
                'slug'                  => 'gravityforms', // The plugin slug (typically the folder name)
                'source'                => WD_THEME_PLUGIN . '/gravityforms.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__('WP Rocket', 'feellio'), // The plugin name
                'desc'                  => '', // The plugin description
                'slug'                  => 'wp-rocket', // The plugin slug (typically the folder name)
                'source'                => WD_THEME_PLUGIN . '/wp-rocket.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__('Toolset Types', 'feellio'), // The plugin name
                'desc'                  => '', // The plugin description
                'slug'                  => 'types', // The plugin slug (typically the folder name)
                'source'                => WD_THEME_PLUGIN . '/types.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__('WP Smushit', 'feellio'), // The plugin name
                'desc'                  => '', // The plugin description
                'slug'                  => 'wp-smushit', // The plugin slug (typically the folder name)
                'source'                => WD_THEME_PLUGIN . '/wp-smushit.zip', // The plugin source
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
                'version'               => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'          => '', // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'                  => esc_html__('Classic Editor', 'ifind'), // The plugin name
                'slug'                  => 'classic-editor', // The plugin slug (typically the folder name)
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name'                  => esc_html__('User Role Editor', 'ifind'), // The plugin name
                'slug'                  => 'user-role-editor', // The plugin slug (typically the folder name)
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name'                  => esc_html__('Redux Framework', 'ifind'), // The plugin name
                'slug'                  => 'redux-framework', // The plugin slug (typically the folder name)
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
            ),
            array(
                'name'                  => esc_html__('Duplicate Post', 'ifind'), // The plugin name
                'slug'                  => 'duplicate-post', // The plugin slug (typically the folder name)
                'required'              => true, // If false, the plugin is only 'recommended' instead of required
            ),
        ); //End plugins
        $wd_config = array(
            'default_path'      => '',
            'menu'              => 'tgmpa-install-plugins',
            'has_notices'       => true,
            'dismissable'       => true,
            'dismiss_msg'       => '',
            'is_automatic'      => false,
            'message'           => '',
            'strings' => array(
                'page_title'                        => esc_html__('Install Required Plugins', 'ifind'),
                'menu_title'                        => esc_html__('Install Plugins', 'ifind'),
                'installing'                        => esc_html__('Installing Plugin: %s', 'ifind'),
                'oops'                              => esc_html__('Something went wrong with the plugin API.', 'ifind'),
                'notice_can_install_required'       => _n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.','ifind'),
                'notice_can_install_recommended'    => _n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.','ifind'),
                'notice_cannot_install'             => _n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.','ifind'),
                'notice_can_activate_required'      => _n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.','ifind'),
                'notice_can_activate_recommended'   => _n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.','ifind'),
                'notice_cannot_activate'            => _n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.','ifind'),
                'notice_ask_to_update'              => _n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.','ifind'),
                'notice_cannot_update'              => _n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.','ifind'),
                'install_link'                      => _n_noop('Begin installing plugin', 'Begin installing plugins','ifind'),
                'activate_link'                     => _n_noop('Begin activating plugin', 'Begin activating plugins','ifind'),
                'return'                            => esc_html__('Return to Required Plugins Installer', 'ifind'),
                'plugin_activated'                  => esc_html__('Plugin activated successfully.', 'ifind'),
                'complete'                          => esc_html__('All plugins installed and activated successfully. %s', 'ifind'),
                'nag_type'                          => 'updated'
            )
        );
        tgmpa($wd_plugins, $wd_config);
    }
}
//Register Tgmpa Plugin
add_action('tgmpa_register', 'wd_register_tgmpa_plugin');
?>