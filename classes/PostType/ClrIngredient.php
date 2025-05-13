<?php

namespace Clr\PostType;

class ClrIngredient extends ClrPostType {
	public static function setup(): void {
		self::register_ingredients();
		self::register_ingredient_meta();
	}

	public static function register_ingredients(): void {
		$labels = array(
			'name'                  => __( 'Ingredients', 'clr-brands' ),
			'singular_name'         => __( 'Ingredient', 'clr-brands' ),
			'menu_name'             => __( 'Ingredients', 'clr-brands' ),
			'name_admin_bar'        => __( 'Ingredient', 'clr-brands' ),
			'add_new'               => __( 'Add New', 'clr-brands' ),
			'add_new_item'          => __( 'Add New Ingredient', 'clr-brands' ),
			'new_item'              => __( 'New Ingredient', 'clr-brands' ),
			'edit_item'             => __( 'Edit Ingredient', 'clr-brands' ),
			'view_item'             => __( 'View Ingredient', 'clr-brands' ),
			'all_items'             => __( 'All Ingredients', 'clr-brands' ),
			'search_items'          => __( 'Search Ingredients', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent Ingredients:', 'clr-brands' ),
			'not_found'             => __( 'No ingredients found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No ingredients found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'Ingredient Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set ingredient image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove ingredient image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as ingredient image', 'clr-brands' ),
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
			'menu_icon'          => 'dashicons-color-picker', // Dashicon
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'ingredient', $args );
	}

	public static function register_ingredient_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_ingredient_meta' ], - 1 );
	}

	public static function acf_add_ingredient_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_ingredient_meta',
			'title'                 => 'Ingredient Settings',
			'fields'                => self::ingredient_meta_config(),
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
						'value'    => 'ingredient',
					),
				),
			),
		) );
	}

	protected static function ingredient_meta_config(): array {
		$fields = [
			[
				'key'   => 'type_and_code',
				'label' => 'Type And Code',
				'name'  => 'type_and_code',
				'type'  => 'text',
			],
			[
				'key'   => 'epa_approved',
				'label' => 'EPA Approved',
				'name'  => 'epa_approved',
				'type'  => 'true_false',
			],
			[
				'key'   => 'ingr_code',
				'label' => 'Code',
				'name'  => 'ingr_code',
				'type'  => 'text',
			],
			[
				'key'   => 'non_ca_description',
				'label' => 'Non CA Description',
				'name'  => 'non_ca_description',
				'type'  => 'textarea',
			]
		];

		return $fields;
	}
}