<?php

namespace Clr\PostType;

class ClrOnlineRetailer extends ClrPostType {
	public static function setup(): void {
		self::register_online_retailers();
		self::register_online_retailer_meta();
	}

	public static function register_online_retailers(): void {
		$labels = array(
			'name'                  => __( 'Online Retailers', 'clr-brands' ),
			'singular_name'         => __( 'Online Retailer', 'clr-brands' ),
			'menu_name'             => __( 'Online Retailers', 'clr-brands' ),
			'name_admin_bar'        => __( 'Online Retailer', 'clr-brands' ),
			'add_new'               => __( 'Add New', 'clr-brands' ),
			'add_new_item'          => __( 'Add New Online Retailer', 'clr-brands' ),
			'new_item'              => __( 'New Online Retailer', 'clr-brands' ),
			'edit_item'             => __( 'Edit Online Retailer', 'clr-brands' ),
			'view_item'             => __( 'View Online Retailer', 'clr-brands' ),
			'all_items'             => __( 'All Online Retailers', 'clr-brands' ),
			'search_items'          => __( 'Search Online Retailers', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent Online Retailers:', 'clr-brands' ),
			'not_found'             => __( 'No online retailers found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No online retailers found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'Online Retailer Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set online retailer image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove online retailer image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as online retailer image', 'clr-brands' ),
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
			'menu_icon'          => 'dashicons-amazon', // Dashicon
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'online_retailer', $args );
	}

	public static function register_online_retailer_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_online_retailer_meta' ], - 1 );
	}

	public static function acf_add_online_retailer_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_online_retailer_meta',
			'title'                 => 'Online Retailer Settings',
			'fields'                => array(
				[
					'key'   => 'online_retailer_link',
					'label' => 'Retailer Link',
					'name'  => 'online_retailer_link',
					'type'  => 'text',
				]
			),
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
						'value'    => 'online_retailer',
					),
				),
			),
		) );
	}
}