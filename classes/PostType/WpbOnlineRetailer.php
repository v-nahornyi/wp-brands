<?php

namespace Wpb\PostType;

class WpbOnlineRetailer extends WpbPostType {
	public static function setup(): void {
		self::register_online_retailers();
		self::register_online_retailer_meta();
	}

	public static function register_online_retailers(): void {
		$labels = array(
			'name'                  => __( 'Online Retailers', 'wpb-brands' ),
			'singular_name'         => __( 'Online Retailer', 'wpb-brands' ),
			'menu_name'             => __( 'Online Retailers', 'wpb-brands' ),
			'name_admin_bar'        => __( 'Online Retailer', 'wpb-brands' ),
			'add_new'               => __( 'Add New', 'wpb-brands' ),
			'add_new_item'          => __( 'Add New Online Retailer', 'wpb-brands' ),
			'new_item'              => __( 'New Online Retailer', 'wpb-brands' ),
			'edit_item'             => __( 'Edit Online Retailer', 'wpb-brands' ),
			'view_item'             => __( 'View Online Retailer', 'wpb-brands' ),
			'all_items'             => __( 'All Online Retailers', 'wpb-brands' ),
			'search_items'          => __( 'Search Online Retailers', 'wpb-brands' ),
			'parent_item_colon'     => __( 'Parent Online Retailers:', 'wpb-brands' ),
			'not_found'             => __( 'No online retailers found.', 'wpb-brands' ),
			'not_found_in_trash'    => __( 'No online retailers found in Trash.', 'wpb-brands' ),
			'featured_image'        => _x( 'Online Retailer Image', 'wpb-brands' ),
			'set_featured_image'    => _x( 'Set online retailer image', 'wpb-brands' ),
			'remove_featured_image' => _x( 'Remove online retailer image', 'wpb-brands' ),
			'use_featured_image'    => _x( 'Use as online retailer image', 'wpb-brands' ),
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
			'menu_icon'          => 'dashicons-amazon',
			'show_in_rest'       => true,
			'taxonomies'         => array( 'category', 'post_tag' )
		);

		register_post_type( 'online_retailer', $args );
	}

	public static function register_online_retailer_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_online_retailer_meta' ], - 1 );
	}

	public static function acf_add_online_retailer_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_wpb_online_retailer_meta',
			'title'                 => 'Online Retailer Settings',
			'fields'                => array(
				[
					'key'   => 'online_retailer_link',
					'label' => 'Retailer Link',
					'name'  => 'online_retailer_link',
					'type'  => 'text',
				],
				[
					'key'   => 'online_retailer_logo',
					'label' => 'Logo',
					'name'  => 'online_retailer_logo',
					'type'  => 'image',
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