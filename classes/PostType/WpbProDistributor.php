<?php

namespace Wpb\PostType;

class WpbProDistributor extends WpbPostType {
	public static function setup(): void {
		self::register_pro_distributor();
		self::register_pro_distributor_meta();
	}

	public static function register_pro_distributor(): void {
		$labels = array(
			'name'                  => __( 'Pro Distributors', 'wpb-brands' ),
			'singular_name'         => __( 'Pro Distributor', 'wpb-brands' ),
			'menu_name'             => __( 'Pro Distributors', 'wpb-brands' ),
			'name_admin_bar'        => __( 'Pro Distributors', 'wpb-brands' ),
			'add_new'               => __( 'Add New', 'wpb-brands' ),
			'add_new_item'          => __( 'Add New Pro Distributor', 'wpb-brands' ),
			'new_item'              => __( 'New Pro Distributor', 'wpb-brands' ),
			'edit_item'             => __( 'Edit Pro Distributor', 'wpb-brands' ),
			'view_item'             => __( 'View Pro Distributors', 'wpb-brands' ),
			'all_items'             => __( 'All Pro Distributors', 'wpb-brands' ),
			'search_items'          => __( 'Search Pro Distributors', 'wpb-brands' ),
			'parent_item_colon'     => __( 'Parent Pro Distributors:', 'wpb-brands' ),
			'not_found'             => __( 'No Pro Distributors found.', 'wpb-brands' ),
			'not_found_in_trash'    => __( 'No Pro Distributors found in Trash.', 'wpb-brands' ),
			'featured_image'        => _x( 'Pro Distributor Image', 'wpb-brands' ),
			'set_featured_image'    => _x( 'Set Pro Distributor image', 'wpb-brands' ),
			'remove_featured_image' => _x( 'Remove Pro Distributor image', 'wpb-brands' ),
			'use_featured_image'    => _x( 'Use as Pro Distributor image', 'wpb-brands' ),
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
			'menu_icon'          => 'dashicons-groups',
			'show_in_rest'       => true,
			'taxonomies'         => array( 'category', 'post_tag' )
		);

		register_post_type( 'pro_distributors', $args );
	}

	public static function register_pro_distributor_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_pro_distributor_meta' ], - 1 );
	}

	public static function acf_add_pro_distributor_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_wpb_pro_distributors_meta',
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