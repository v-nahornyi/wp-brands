<?php

namespace Clr\PostType;

class ClrProDistributor extends ClrPostType {
	public static function setup(): void {
		self::register_pro_distributor();
		self::register_pro_distributor_meta();
	}

	public static function register_pro_distributor(): void {
		$labels = array(
			'name'                  => __( 'Pro Distributors', 'clr-brands' ),
			'singular_name'         => __( 'Pro Distributor', 'clr-brands' ),
			'menu_name'             => __( 'Pro Distributors', 'clr-brands' ),
			'name_admin_bar'        => __( 'Pro Distributors', 'clr-brands' ),
			'add_new'               => __( 'Add New', 'clr-brands' ),
			'add_new_item'          => __( 'Add New Pro Distributor', 'clr-brands' ),
			'new_item'              => __( 'New Pro Distributor', 'clr-brands' ),
			'edit_item'             => __( 'Edit Pro Distributor', 'clr-brands' ),
			'view_item'             => __( 'View Pro Distributors', 'clr-brands' ),
			'all_items'             => __( 'All Pro Distributors', 'clr-brands' ),
			'search_items'          => __( 'Search Pro Distributors', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent Pro Distributors:', 'clr-brands' ),
			'not_found'             => __( 'No Pro Distributors found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No Pro Distributors found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'Pro Distributor Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set Pro Distributor image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove Pro Distributor image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as Pro Distributor image', 'clr-brands' ),
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => 20,
			'menu_icon'          => 'dashicons-groups', // Dashicon
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'pro_distributors', $args );
	}

	public static function register_pro_distributor_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_pro_distributor_meta' ], - 1 );
	}

	public static function acf_add_pro_distributor_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_pro_distributors_meta',
			'title'                 => 'Pro Distributors Settings',
			'fields'                => self::pro_distributors_meta_config(),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'location'              => array(
				array(
					array(
						'param'    => 'post_type',
						'operator' => '==',
						'value'    => 'pro_distributors',
					),
				),
			),
		) );
	}

	protected static function pro_distributors_meta_config(): array {
		$fields = [
			[
				'key'   => 'pro_distributors_link',
				'label' => 'Link',
				'name'  => 'pro_distributors_link',
				'type'  => 'text',
			],
			[
				'key'   => 'in_footer',
				'label' => 'In Footer',
				'name'  => 'in_footer',
				'type'  => 'true_false',
			],
			[
				'key'   => 'pro_distributors_item_order',
				'label' => 'Item Order',
				'name'  => 'pro_distributors_item_order',
				'type'  => 'number',
			],
		];

		return $fields;
	}
}