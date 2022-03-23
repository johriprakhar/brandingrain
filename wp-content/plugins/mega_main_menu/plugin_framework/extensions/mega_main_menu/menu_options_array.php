<?php
/**
 * @package MegaMain
 * @subpackage MegaMain
 * @since mm 1.0
 */

    function mmpm_menu_options_array(){
        $post_types = get_post_types( $args = array( 'public' => true, 'exclude_from_search' => false ), 'names' );
        unset( $post_types['attachment'] );
        /* Additional styles */
        $additional_styles_presets = mmpm_get_option( 'additional_styles_presets' );
        unset( $additional_styles_presets['0'] );
        $additional_styles[ __( 'Default', MMPM_TEXTDOMAIN_ADMIN ) ] = 'default_style';

        /* My own additional styles */
        $additional_styles[ __( 'Highlight', MMPM_TEXTDOMAIN_ADMIN ) ] = 'highlight_style';
        $additional_styles[ __( 'Section Header', MMPM_TEXTDOMAIN_ADMIN ) ] = 'section_header_style';
        $additional_styles[ __( 'Button', MMPM_TEXTDOMAIN_ADMIN ) ] = 'button_style';
        //$additional_styles[ __( 'Button Alternative', MMPM_TEXTDOMAIN_ADMIN ) ] = 'button_alt_style';
        $additional_styles[ __( 'Logo', MMPM_TEXTDOMAIN_ADMIN ) ] = 'logo_style';

        $additional_styles = apply_filters("iv_megamenu_styles", $additional_styles);

        /*
        if ( is_array( $additional_styles_presets ) ) {
            foreach ( $additional_styles_presets as $key => $value) {
                $additional_styles[ $key . '. ' . $value['style_name'] ] = 'additional_style_' . $key;
            }
        }
        */

        /* Submenu types */
        $number_of_widgets = mmpm_get_option( 'number_of_widgets', '1' );
        if ( is_numeric( $number_of_widgets ) ) {
            for ( $i=1; $i <= $number_of_widgets; $i++ ) { 
                $submenu_widgets[ __( 'Widgets area ', MMPM_TEXTDOMAIN_ADMIN ) . $i ] = MMPM_PREFIX . '_menu_widgets_area_' . $i;
            }
        }
        $submenu_types = array(
            __( 'Standard Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'default_dropdown',
            __( 'Multicolumn Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'multicolumn_dropdown',
            //__( 'Grid Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'grid_dropdown',
            //__( 'Posts Grid Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'post_type_dropdown',
        );
        $submenu_types = array_merge( $submenu_types, $submenu_widgets );
        /* options */
        $options = array(
/* for better times
                array(
                    'key' => 'show_mega_options',
                    'type' => 'select',
                    'values' => array(
                        __( 'Hide Mega Options', MMPM_TEXTDOMAIN_ADMIN ) => 'false',
                        __( 'Show Mega Options', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                    'dependency' => array(
                        'element' => array( 
                            'item_icon', 
                            'disable_text', 
                            'disable_link',
                            'disable_icon',
                            'submenu_type',
                            'submenu_drops_side',
                            'submenu_disable_icons',
                            'submenu_enable_full_width',
                            'submenu_columns',
                            'submenu_custom_content',
                        ),
                        'value' => 'true',
                    ),
                ),
*/
                array(
                    'descr' => __( 'Icon of This item', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'item_icon',
                    'type' => 'icons',
                ),
                /*
                array(
                    'key' => 'disable_icon',
                    'type' => 'checkbox',
                    'values' => array(
                        __( 'Hide Icon of This Item', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                ),
                */
                array(
                    'key' => 'disable_text',
                    'type' => 'checkbox',
                    'values' => array(
                        __( 'Hide Text of This Item', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                ),
                array(
                    'key' => 'disable_link',
                    'type' => 'checkbox',
                    'values' => array(
                        __( 'Disable Link', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                ),
                array(
                    'name' => __( 'Options of Dropdown', MMPM_TEXTDOMAIN_ADMIN ),
                    'descr' => __( 'Submenu Type', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'submenu_type',
                    'type' => 'select',
                    'values' => $submenu_types,
/* for better times
                    array(
                        __( 'Standard Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'default_dropdown',
                        __( 'Multicolumn Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'multicolumn_dropdown',
                        __( 'Grid Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'grid_dropdown',
                        __( 'Posts Grid Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'post_type_dropdown',
                        __( 'Widgets First Area Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'widgets_first_dropdown',
                        __( 'Widgets Second Area Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'widgets_second_dropdown',
                        __( 'Custom Content Dropdown', MMPM_TEXTDOMAIN_ADMIN ) => 'custom_dropdown',
                    ),
*/
                    'dependency' => array(
                        'element' => array( 
                            'submenu_post_type', 
                        ),
                        'value' => 'post_type_dropdown',
                    ),

               ),
                array(
                    'key' => 'submenu_post_type',
                    'descr' => __( 'Post Type For Display In Dropdown', MMPM_TEXTDOMAIN_ADMIN ),
                    'type' => 'select',
                    'values' => $post_types,
                ),
                array(
                    'key' => 'submenu_drops_side',
                    'descr' => __( 'Side of dropdown elements', MMPM_TEXTDOMAIN_ADMIN ),
                    'type' => 'select',
                    'values' => array(
                        __( 'Drop To Right Side', MMPM_TEXTDOMAIN_ADMIN ) => 'drop_to_right',
                        __( 'Drop To Left Side', MMPM_TEXTDOMAIN_ADMIN ) => 'drop_to_left',
                        __( 'Drop To Center', MMPM_TEXTDOMAIN_ADMIN ) => 'drop_to_center',
                    ),
                ),
                array(
                    'descr' => __( 'Submenu Columns (Not For Standard Drops)', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'submenu_columns',
                    'type' => 'select',
                    'values' => range(1, 10),
                ),
/* for better times
                array(
                    'key' => 'submenu_disable_icons',
                    'type' => 'checkbox',
                    'values' => array(
                        __( 'Disable Submenu Icons', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                ),
*/
                array(
                    'key' => 'submenu_enable_full_width',
                    'type' => 'checkbox',
                    'values' => array(
                        __( 'Enable Full Width Dropdown (only for horizontal menu)', MMPM_TEXTDOMAIN_ADMIN ) => 'true',
                    ),
                ),
/* for better times
                array(
                    'descr' => __( 'Custom Content (Shorcodes supported, only for "Multicolumn" and "Custom" Dropdown)', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'submenu_custom_content',
                    'type' => 'textarea',
                    'values' => '',
                ),
*/
                array(
                    'name' => __( 'Dropdown Background Image', MMPM_TEXTDOMAIN_ADMIN ),
                    'descr' => __( '', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'submenu_bg_image',
                    'type' => 'background_image',
                    'default' => '',
                ),
        );

        if ( count( $additional_styles ) > 1 ) {
            array_unshift( 
                $options, 
                array(
                    'descr' => __( 'Style of This Item', MMPM_TEXTDOMAIN_ADMIN ),
                    'key' => 'item_style',
                    'type' => 'select',
                    'values' => $additional_styles,
                    'default' => 'default',
                )
            );
        }

        return $options;
    }
?>