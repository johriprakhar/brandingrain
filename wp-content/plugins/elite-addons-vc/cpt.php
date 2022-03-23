<?php
/***
 * File used to register custom post type and terms used in our Projects Module
 *
 **/

if( ivan_vc_get_option('ivan_vc_disable_cpt') != true ) :

	// Register Projects Post Type
	register_post_type( 'ivan_vc_projects', array(
		'menu_icon' => 'dashicons-feedback',
		'labels' => array(
			'name' => __( 'Projects', '_sdomain' ),
			'singular_name' => __( 'Project', '_sdomain' ),
			'add_new' => __( 'Add Project', '_sdomain' ),
			'add_new_item' => __( 'Add Project', '_sdomain' ),
			'edit' => __( 'Edit', '_sdomain' ),
			'edit_item' => __( 'Edit Project', '_sdomain' ),
			'new_item' => __( 'New Project', '_sdomain' ),
			'view' => __( 'View Project', '_sdomain' ),
			'view_item' => __( 'View Project', '_sdomain' ),
			'search_items' => __( 'Search Project', '_sdomain' ),
			'not_found' => __( 'No Project found', '_sdomain' ),
			'not_found_in_trash' => __( 'No Project found in Trash', '_sdomain' ),
			'parent' => __( 'Parent Project', '_sdomain' ),
		),
		//'has_archive' => true,
		'publicly_queryable' => true,
		'public' => true,
		'rewrite' => array( 'slug' => apply_filters('ivan_vc_project_slug', 'project') ),
		'supports' => array( 'title', 'excerpt', 'editor', 'thumbnail', ''  ),
		//'taxonomies' => array('post_tag'),
	));	

	add_action('init', 'ivan_vc_register_tax');
	function ivan_vc_register_tax() {

		// Projects Category Term
		register_taxonomy(
			'ivan_vc_projects_sizes', 
			apply_filters('ivan_vc_sizes_tax', array('ivan_vc_projects', 'post') ), 
			array( 
				'label' => 'Sizes', 
				'hierarchical' => false,
				//'show_ui' => false,
				'show_in_nav_menus' => false,
				'show_admin_column' => true,
				'public' => true,
			)
		);

		// Projects Category Term
		register_taxonomy(
			'ivan_vc_projects_cats', 
			apply_filters('ivan_vc_cats_tax', array('ivan_vc_projects') ), 
			array( 
				'label' => 'Categories', 
				'hierarchical' => true,
				'show_admin_column' => true,
				'public' => true, 
				'rewrite' => array( 'slug' => apply_filters('ivan_vc_category_slug', 'category') ), 
			)
		);

		// Projects Category Term
		register_taxonomy(
			'ivan_vc_projects_portfolios', 
			apply_filters('ivan_vc_portfolios_tax', array('ivan_vc_projects') ), 
			array( 
				'label' => 'Portfolios', 
				'hierarchical' => true,
				'show_admin_column' => true,
				'public' => true, 
				'rewrite' => array( 'slug' => apply_filters('ivan_vc_portfolio_slug', 'portfolio') ), 
			)
		);
	}

endif; // settings page opt

add_action( 'after_setup_theme', 'ivan_vc_img_sizes_setup' );
function ivan_vc_img_sizes_setup() {
	// Registering Image Sizes
	add_image_size('ivan_project', 480, 480, false);
	add_image_size('ivan_project_crop', 480, 480, true);
	add_image_size('ivan_project_wide_crop', 480, 320, true);
	add_image_size('ivan_project_large', 900, 900, false);
	add_image_size('ivan_project_large_crop', 900, 900, true);
	add_image_size('ivan_project_large_wide_crop', 900, 600, true);
	
	//portfolio modern
	add_image_size('ivan_portfolio_high', 378, 493, true);
	add_image_size('ivan_portfolio_default', 378, 246, true);
	add_image_size('ivan_portfolio_doubled', 757, 493, true);
}

add_action( 'vc_after_init', 'vc_after_init_actions' );
 
function vc_after_init_actions() {
	if( function_exists('vc_remove_element') ){ 
		vc_remove_element( 'vc_media_grid' );
		vc_remove_element( 'vc_basic_grid' );
		vc_remove_element( 'vc_masonry_grid' );
		vc_remove_element( 'vc_masonry_media_grid' );    
    }
}