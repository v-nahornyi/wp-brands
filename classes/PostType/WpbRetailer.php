<?php

namespace Wpb\PostType;

class WpbRetailer extends WpbPostType {
	public static function setup(): void {
		self::register_retailer();
		self::register_retailer_meta();
	}

	public static function register_retailer(): void {
		$labels = array(
			'name'                  => __( 'Retailers', 'wpb-brands' ),
			'singular_name'         => __( 'Retailer', 'wpb-brands' ),
			'menu_name'             => __( 'Retailers', 'wpb-brands' ),
			'name_admin_bar'        => __( 'Retailers', 'wpb-brands' ),
			'add_new'               => __( 'Add New Retailer', 'wpb-brands' ),
			'add_new_item'          => __( 'Add New Retailer', 'wpb-brands' ),
			'new_item'              => __( 'New Retailer', 'wpb-brands' ),
			'edit_item'             => __( 'Edit Retailer', 'wpb-brands' ),
			'view_item'             => __( 'View Retailer', 'wpb-brands' ),
			'all_items'             => __( 'All Retailers', 'wpb-brands' ),
			'search_items'          => __( 'Search Retailers', 'wpb-brands' ),
			'parent_item_colon'     => __( 'Parent Retailers:', 'wpb-brands' ),
			'not_found'             => __( 'No Retailers found.', 'wpb-brands' ),
			'not_found_in_trash'    => __( 'No Retailers found in Trash.', 'wpb-brands' ),
			'featured_image'        => _x( 'Retailer Image', 'wpb-brands' ),
			'set_featured_image'    => _x( 'Set Retailer image', 'wpb-brands' ),
			'remove_featured_image' => _x( 'Remove Retailer image', 'wpb-brands' ),
			'use_featured_image'    => _x( 'Use as Retailer image', 'wpb-brands' ),
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
			'menu_icon'          => 'dashicons-admin-home',
			'show_in_rest'       => true,
			'taxonomies'         => array( 'category' )
		);

		register_post_type( 'retailer', $args );
	}

	public static function register_retailer_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_retailer_meta' ], - 1 );
	}

	public static function acf_add_retailer_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_wpb_retailer_meta',
			'title'                 => 'Retailer Settings',
			'fields'                => self::retailer_meta_config(),
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
						'value'    => 'retailer',
					),
				),
			),
		) );
	}

	protected static function retailer_meta_config(): array {
		$fields = [
			[
				'key'   => 'retailer_id',
				'label' => 'Retailer ID',
				'name'  => 'retailer_id',
				'type'  => 'number',
			],
			[
				'key'           => 'retailer_wtb_stock',
				'label'         => 'Product Stock',
				'name'          => 'retailer_wtb_stock',
				'type'          => 'post_object',
				'return_format' => 'object',
				'post_type'     => [ 'product' ],
				'taxonomy' => array(
					'product_cat:wtb',
				),
				'multiple'      => true,
			],
		];

		return $fields;
	}
}