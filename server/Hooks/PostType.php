<?php

namespace LEADGEN\Hooks;

class PostType implements IHook {

	public function register(): void {
		add_action( 'init', array( &$this, 'define' ) );
	}

	public function define(): void {
		$labels = [
			'name'               => __( 'Customers', LEADGEN_TEXT_DOMAIN ),
			'singular_name'      => __( 'Customers', LEADGEN_TEXT_DOMAIN ),
			'menu_name'          => __( 'Customers', LEADGEN_TEXT_DOMAIN ),
			'name_admin_bar'     => __( 'Customer', LEADGEN_TEXT_DOMAIN ),
			'add_new'            => __( 'Add New', LEADGEN_TEXT_DOMAIN ),
			'add_new_item'       => __( 'Add New Customer', LEADGEN_TEXT_DOMAIN ),
			'new_item'           => __( 'New Customer', LEADGEN_TEXT_DOMAIN ),
			'edit_item'          => __( 'Edit Customer', LEADGEN_TEXT_DOMAIN ),
			'view_item'          => __( 'View Customer', LEADGEN_TEXT_DOMAIN ),
			'all_items'          => __( 'All Customers', LEADGEN_TEXT_DOMAIN ),
			'search_items'       => __( 'Search Customers', LEADGEN_TEXT_DOMAIN ),
			'parent_item_colon'  => __( 'Parent Customer:', LEADGEN_TEXT_DOMAIN ),
			'not_found'          => __( 'No customers found.', LEADGEN_TEXT_DOMAIN ),
			'not_found_in_trash' => __( 'No customers found in Trash.', LEADGEN_TEXT_DOMAIN )
		];

		$args = array(
			'labels'       => $labels,
			'description'  => __( 'Description.', LEADGEN_TEXT_DOMAIN ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_menu' => true,
			'query_var'    => false,
			'rewrite'      => [ 'slug' => 'elegant-customer' ],
			'taxonomies'   => [],
			'capabilities' => [
				'edit_post'          => 'manage_options',
				'read_post'          => 'manage_options',
				'delete_post'        => 'manage_options',
				'edit_posts'         => 'manage_options',
				'edit_others_posts'  => 'manage_options',
				'delete_posts'       => 'manage_options',
				'publish_posts'      => 'manage_options',
				'read_private_posts' => 'manage_options'
			],
			'hierarchical' => false,
			'supports'     => [ 'title' ]
		);

		register_post_type( LEADGEN_CPT_SLUG, $args );
	}
}
