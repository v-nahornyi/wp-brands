<?php

namespace Clr\PostType;

class ClrLocation extends ClrPostType {
	public static function setup(): void {
		self::register_location();
		self::register_location_meta();
	}

	public static function register_location(): void {
		$labels = array(
			'name'                  => __( 'Locations', 'clr-brands' ),
			'singular_name'         => __( 'Location', 'clr-brands' ),
			'menu_name'             => __( 'Locations', 'clr-brands' ),
			'name_admin_bar'        => __( 'Locations', 'clr-brands' ),
			'add_new'               => __( 'Add New Location', 'clr-brands' ),
			'add_new_item'          => __( 'Add New Location', 'clr-brands' ),
			'new_item'              => __( 'New Location', 'clr-brands' ),
			'edit_item'             => __( 'Edit Location', 'clr-brands' ),
			'view_item'             => __( 'View Location', 'clr-brands' ),
			'all_items'             => __( 'All Locations', 'clr-brands' ),
			'search_items'          => __( 'Search Locations', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent Locations:', 'clr-brands' ),
			'not_found'             => __( 'No Locations found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No Locations found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'Location Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set Location image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove Location image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as Location image', 'clr-brands' ),
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
			'menu_icon'          => 'dashicons-location', // Dashicon
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'location', $args );
	}

	public static function register_location_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_location_meta' ], - 1 );
	}

	public static function acf_add_location_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_location_meta',
			'title'                 => 'Location Settings',
			'fields'                => self::location_meta_config(),
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
						'value'    => 'location',
					),
				),
			),
		) );
	}

	protected static function location_meta_config(): array {
		$fields = [
			[
				'key'   => 'retailer',
				'label' => 'Retailer',
				'name'  => 'retailer',
				'type'  => 'number',
			],
			[
				'key'   => 'location_street',
				'label' => 'Location street',
				'name'  => 'location_street',
				'type'  => 'text',
			],
			[
				'key'   => 'location_city',
				'label' => 'Location city',
				'name'  => 'location_city',
				'type'  => 'text',
			],
			[
				'key'   => 'location_county',
				'label' => 'Location county',
				'name'  => 'location_county',
				'type'  => 'text',
			],
			[
				'key'   => 'location_state',
				'label' => 'Location state',
				'name'  => 'location_state',
				'type'  => 'text',
			],
			[
				'key'   => 'location_country',
				'label' => 'Location country',
				'name'  => 'location_country',
				'type'  => 'text',
			],
			[
				'key'   => 'location_zip',
				'label' => 'Location zip code',
				'name'  => 'location_zip',
				'type'  => 'number',
			],
			[
				'key'   => 'location_longitude',
				'label' => 'Location longitude',
				'name'  => 'location_longitude',
				'type'  => 'text',
			],
			[
				'key'   => 'location_latitude',
				'label' => 'Location latitude',
				'name'  => 'location_latitude',
				'type'  => 'text',
			],
			[
				'key'   => 'location_geoaccuracy',
				'label' => 'Location geoaccuracy',
				'name'  => 'location_geoaccuracy',
				'type'  => 'text',
			],
			[
				'key'   => 'location_phone',
				'label' => 'Location phone',
				'name'  => 'location_phone',
				'type'  => 'text',
			],
		];

		return $fields;
	}
}