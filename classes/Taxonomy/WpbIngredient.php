<?php

namespace Wpb\Taxonomy;

class WpbIngredient {
	public static function setup(): void {
		self::register_ingredients();
		self::register_ingredient_meta();
	}

	public static function register_ingredients(): void {
		register_taxonomy( 'ingredient', 'product',
			array(
				'labels'             => array(
					'name'          => 'Ingredients',
					'singular_name' => 'Ingredient',
					'menu_name'     => 'Ingredients',
				),
				'hierarchical'       => false,
				'show_ui'            => true,
				'show_in_quick_edit' => false,
				'meta_box_cb'        => false,
				'show_admin_column'  => false,
				'show_in_nav_menus'  => false,
				'show_in_rest'       => false,
				'rewrite'            => array( 'slug' => 'ingredient' ),
			)
		);
	}

	public static function register_ingredient_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_ingredient_meta' ], - 1 );
	}

	public static function acf_add_ingredient_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_wpb_ingredient_meta',
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
						'param'    => 'taxonomy',
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