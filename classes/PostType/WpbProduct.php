<?php

namespace Wpb\PostType;

use Wpb\Taxonomy\WpbAvailableSize;
use Wpb\Taxonomy\WpbIngredient;

class WpbProduct extends WpbPostType {
	public static function setup(): void {
		self::register_products();
		self::register_categories();
		self::register_product_meta();
		self::register_proline();
		self::setup_taxonomies();
	}

	public static function register_products(): void {
		$labels = array(
			'name'                  => __( 'Products', 'wpb-brands' ),
			'singular_name'         => __( 'Product', 'wpb-brands' ),
			'menu_name'             => __( 'Products', 'wpb-brands' ),
			'name_admin_bar'        => __( 'Product', 'wpb-brands' ),
			'add_new'               => __( 'Add New', 'wpb-brands' ),
			'add_new_item'          => __( 'Add New Product', 'wpb-brands' ),
			'new_item'              => __( 'New Product', 'wpb-brands' ),
			'edit_item'             => __( 'Edit Product', 'wpb-brands' ),
			'view_item'             => __( 'View Product', 'wpb-brands' ),
			'all_items'             => __( 'All Products', 'wpb-brands' ),
			'search_items'          => __( 'Search Products', 'wpb-brands' ),
			'parent_item_colon'     => __( 'Parent Products:', 'wpb-brands' ),
			'not_found'             => __( 'No products found.', 'wpb-brands' ),
			'not_found_in_trash'    => __( 'No products found in Trash.', 'wpb-brands' ),
			'featured_image'        => _x( 'Product Image', 'wpb-brands' ),
			'set_featured_image'    => _x( 'Set product image', 'wpb-brands' ),
			'remove_featured_image' => _x( 'Remove product image', 'wpb-brands' ),
			'use_featured_image'    => _x( 'Use as product image', 'wpb-brands' ),
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
			'menu_icon'          => 'dashicons-cart', // Dashicon
			'supports'           => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'comments'
			),
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'product', $args );
	}

	public static function register_categories(): void {
		register_taxonomy( 'product_cat', 'product',
			array(
				'labels'            => array(
					'name'          => 'Product category',
					'singular_name' => 'Product category',
					'menu_name'     => 'Product Categories',
				),
				'hierarchical'      => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_in_rest'      => true,
				'rewrite'           => array( 'slug' => 'product-category' ),
			)
		);

		wp_insert_term( 'Proline', 'product_cat' );
		wp_insert_term( 'WTB', 'product_cat' );
	}

	public static function register_product_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_product_meta' ], - 1 );
	}

	public static function acf_add_product_meta(): void {
		acf_add_local_field_group(
			array(
				'key'                   => 'group_wpb_product_meta',
				'title'                 => 'Product Settings',
				'fields'                => self::product_meta_config(),
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
							'value'    => 'product',
						),
					),
				),
			)
		);
	}

	protected static function product_meta_config(): array {
		$fields = [
			// Image (ACF Image Picker)
			[
				'key'   => 'product_image',
				'label' => 'Image',
				'name'  => 'product_image',
				'type'  => 'gallery',
			],
			[
				'key'   => 'bg_image',
				'label' => 'Background Image',
				'name'  => 'bg_image',
				'type'  => 'image',
			],
			[
				'key'           => 'videos',
				'label'         => 'Videos',
				'name'          => 'videos',
				'type'          => 'repeater',
				'layout'        => 'row',
				'min'           => 0,
				'max'           => 0,
				'pagination'    => 0,
				'collapsed'     => '',
				'button_label'  => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields'    => [
					[
						'key'               => 'video_file',
						'name'              => 'video_file',
						'type'              => 'file',
						'return_format'     => 'array',
						'library'           => 'all',
						'allow_in_bindings' => 0,
						'preview_size'      => 'medium',
					],
					[
						'key'   => 'video_title',
						'label' => 'Video Title',
						'name'  => 'video_title',
						'type'  => 'text',
					],
					[
						'key'   => 'video_desc',
						'label' => 'Video Description',
						'name'  => 'video_desc',
						'type'  => 'text',
					]
				]
			],
			[
				'key'           => 'faq',
				'label'         => 'FAQ',
				'name'          => 'faq',
				'type'          => 'repeater',
				'layout'        => 'row',
				'min'           => 0,
				'max'           => 0,
				'pagination'    => 0,
				'collapsed'     => '',
				'button_label'  => 'Add Row',
				'rows_per_page' => 20,
				'sub_fields'    => [
					[
						'key'   => 'faq_title',
						'name'  => 'faq_title',
						'label' => 'FAQ Title',
						'type'  => 'text',
					],
					[
						'key'   => 'faq_desc',
						'name'  => 'faq_desc',
						'label' => 'FAQ Description',
						'type'  => 'textarea',
					]
				]
			],
			[
				'key'               => 'badge_type',
				'label'             => 'Badge Type',
				'name'              => 'badge_type',
				'type'              => 'radio',
				'choices'           => [
					'image' => 'Image',
					'text'  => 'Text',
				],
				'default_value'     => '',
				'return_format'     => 'value',
				'other_choice'      => 0,
				'allow_in_bindings' => 0,
				'layout'            => 'vertical',
				'save_other_choice' => 0,
			],
			[
				'key'               => 'badge_text',
				'label'             => 'Badge Text',
				'name'              => 'badge_text',
				'type'              => 'text',
				'conditional_logic' => [
					[
						[
							'field'    => 'badge_type',
							'operator' => '==',
							'value'    => 'text',
						],
					],
				],
				'allow_in_bindings' => 0,
			],
			[
				'key'               => 'badge_image',
				'label'             => 'Badge Image',
				'name'              => 'badge_image',
				'type'              => 'image',
				'conditional_logic' => [
					[
						[
							'field'    => 'badge_type',
							'operator' => '==',
							'value'    => 'image',
						],
					],
				],
				'allow_in_bindings' => 0,
			],
			// Safety Ingredients (Text Area)
			[
				'key'   => 'safety_ingredients',
				'label' => 'Safety Ingredients',
				'name'  => 'safety_ingredients',
				'type'  => 'textarea',
			],
			// SDS (File Picker)
			[
				'key'   => 'sds',
				'label' => 'SDS',
				'name'  => 'sds',
				'type'  => 'file',
			],
			// Tech Data Sheets (File Picker)
			[
				'key'   => 'tech_data_sheets',
				'label' => 'Tech Data Sheets',
				'name'  => 'tech_data_sheets',
				'type'  => 'file',
			],
			// Product Sell Sheets (File Picker)
			[
				'key'   => 'product_sell_sheets',
				'label' => 'Product Sell Sheets',
				'name'  => 'product_sell_sheets',
				'type'  => 'file',
			],
			// How To Use (File Picker)
			[
				'key'   => 'how_to_use',
				'label' => 'How To Use',
				'name'  => 'how_to_use',
				'type'  => 'wysiwyg',
			],
			[
				'key'   => 'WtbAlt',
				'label' => 'WtbAlt',
				'name'  => 'WtbAlt',
				'type'  => 'text',
			],
			// Product Use (Checkbox)
			[
				'key'     => 'product_use',
				'label'   => 'Product Use',
				'name'    => 'product_use',
				'type'    => 'checkbox',
				'choices' => [
					'multi_use'       => 'Multi Use',
					'routine_clean'   => 'Routine Clean',
					'prevent_protect' => 'Prevent & Protect',
					'refresh_renew'   => 'Refresh & Renew'
				],
			],
			// Rooms (Checkbox)
			[
				'key'     => 'rooms',
				'label'   => 'Rooms',
				'name'    => 'rooms',
				'type'    => 'checkbox',
				'choices' => [
					'bathroom'  => 'Bathroom',
					'kitchen'   => 'Kitchen',
					'garage'    => 'Garage',
					'outdoors'  => 'Outdoors',
					'laundry'   => 'Laundry',
					'specialty' => 'Specialty'
				],
			],
			// Surfaces (Checkbox)
			[
				'key'     => 'surfaces',
				'label'   => 'Surfaces',
				'name'    => 'surfaces',
				'type'    => 'checkbox',
				'choices' => [
					'apparel'                             => 'Apparel',
					'aluminium'                           => 'Aluminium',
					'asphalt'                             => 'Asphalt',
					'baseboards'                          => 'Baseboards',
					'blends'                              => 'Blends',
					'blacktop'                            => 'Blacktop',
					'brick'                               => 'Brick',
					'canvas'                              => 'Canvas',
					'cement'                              => 'Cement',
					'ceramic'                             => 'Ceramic',
					'clear_coat'                          => 'Clear Coat',
					'chrome'                              => 'Chrome',
					'concrete'                            => 'Concrete',
					'copper'                              => 'Copper',
					'corian'                              => 'Corian',
					'cotton'                              => 'Cotton',
					'diamonds'                            => 'Diamonds',
					'fabric'                              => 'Fabric',
					'fiber_bond_carpet'                   => 'Fiber bond carpet',
					'fiberglass'                          => 'Fiberglass',
					'fully_cured_oil'                     => 'Fully cured oil-based painted surfaces',
					'glass'                               => 'Glass',
					'glass_stove_tops'                    => 'Glass Stove Tops',
					'gold'                                => 'Gold',
					'granite'                             => 'Granite',
					'grout'                               => 'Grout',
					'hard_plastics'                       => 'Hard plastics',
					'hardwood'                            => 'Hardwood',
					'laminate'                            => 'Laminate',
					'marble'                              => 'Marble',
					'metal'                               => 'Metal',
					'painted_walls'                       => 'Painted walls',
					'plastic_resin'                       => 'Plastic/Resin',
					'platinum'                            => 'Platinum',
					'polyester'                           => 'Polyester',
					'porcelain'                           => 'Porcelain',
					'pvc'                                 => 'PVC',
					'rattan'                              => 'Rattan',
					'range_hood'                          => 'Range Hood',
					'rubber'                              => 'Rubber',
					'silver_plate'                        => 'Silver plate',
					'sports_uniforms_jersets'             => 'Sports Uniforms, Jersets',
					'sports_equipment'                    => 'Sports Equipment',
					'stainless_steel'                     => 'Stainless Steel',
					'stainless_steel_exteriors'           => 'Stainless Steel Exteriors',
					'stainless_steel_appliance_exteriors' => 'Stainless Steel Appliance Exteriors',
					'sterling_silver'                     => 'Sterling Silver',
					'natural_stones'                      => 'Natural Stones',
					'stucco'                              => 'Stucco',
					'terrazzo'                            => 'Terrazzo',
					'tile'                                => 'Tile',
					'vinyl_siding'                        => 'Vinyl Siding',
					'vinyl'                               => 'Vinyl',
					'caulk'                               => 'Caulk',
					'wicker'                              => 'Wicker',
					'wood'                                => 'Wood',
					'wrought_iron'                        => 'Wrought Iron'
				]
			],
			// SDS Spanish (File Picker)
			[
				'key'   => 'sds_spanish',
				'label' => 'SDS Spanish',
				'name'  => 'sds_spanish',
				'type'  => 'file',
			],
			// Online Available (Checkbox)
			[
				'key'           => 'online_retailers',
				'label'         => 'Online Available',
				'name'          => 'online_retailers',
				'type'          => 'post_object',
				'post_type'     => array( 'online_retailer' ),  // Target CPT
				'multiple'      => 1,        // Allow multiple selections
				'ui'            => 1,        // Enable enhanced UI
				'return_format' => 'object', // Return post objects (or 'id')
				'allow_null'    => 0,
				'ajax'          => 1,        // Helpful for large datasets
				'placeholder'   => 'Select Retailers',
			],
			[
				'key'           => 'product_ingredients',
				'label'         => 'Ingredients',
				'name'          => 'product_ingredients',
				'type'          => 'taxonomy',
				'add_term'      => 0,
				'save_terms'    => 0,
				'load_terms'    => 0,
				'taxonomy'      => 'ingredient',  // Target CPT
				'field_type'    => 'multi_select',
				'ui'            => 1,        // Enable enhanced UI
				'return_format' => 'object', // Return post objects (or 'id')
				'allow_null'    => 0,
				'ajax'          => 1,        // Helpful for large datasets
				'placeholder'   => 'Select Ingredients',
			],
			// Available Sizes (Checkbox)
//			[
//				'key'  => 'available_size',
//				'name' => 'available_size',
//				'taxonomy'      => 'available_size',
//				'filters'       => array( 'taxonomy' ),
//				'min'           => 0,
//				'max'           => 100,
//				'return_format' => 'object',
//			],
			// Custom Surfaces Content (WYSIWYG)
			[
				'key'   => 'custom_surfaces_content',
				'label' => 'Custom Surfaces Content',
				'name'  => 'custom_surfaces_content',
				'type'  => 'wysiwyg',
			],
			// Subhead (Text)
			[
				'key'   => 'subhead',
				'label' => 'Subhead',
				'name'  => 'subhead',
				'type'  => 'text',
			],
			// Custom Size Text (Text Area)
			[
				'key'   => 'custom_size_text',
				'label' => 'Custom Size Text',
				'name'  => 'custom_size_text',
				'type'  => 'wysiwyg',
			],
			// How To Use Header (Text)
			[
				'key'   => 'how_to_use_header',
				'label' => 'How To Use Header',
				'name'  => 'how_to_use_header',
				'type'  => 'text',
			],
			// UPC Code Fields (Text)
			[
				'key'   => 'upc_code',
				'label' => 'UPC Code',
				'name'  => 'upc_code',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt',
				'label' => 'UPC Code Alt',
				'name'  => 'upc_code_alt',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code2',
				'label' => 'UPC Code 2',
				'name'  => 'upc_code2',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt2',
				'label' => 'UPC Code 2 Alt',
				'name'  => 'upc_code_alt2',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code3',
				'label' => 'UPC Code 3',
				'name'  => 'upc_code3',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt3',
				'label' => 'UPC Code 3 Alt',
				'name'  => 'upc_code_alt3',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code4',
				'label' => 'UPC Code 4',
				'name'  => 'upc_code4',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt4',
				'label' => 'UPC Code 4 Alt',
				'name'  => 'upc_code_alt4',
				'type'  => 'text',
			],
			[
				'key'   => 'upc_code5',
				'label' => 'UPC Code 5',
				'name'  => 'upc_code5',
				'type'  => 'file',
			],
			[
				'key'   => 'upc_code_alt5',
				'label' => 'UPC Code 5 Alt',
				'name'  => 'upc_code_alt5',
				'type'  => 'text',
			],
			[
				'key'   => 'sort_top',
				'label' => 'Sort Top',
				'name'  => 'sort_top',
				'type'  => 'true_false',
			],
			// Not Subject to CA Act (True/False)
			[
				'key'   => 'not_subject_to_ca_act',
				'label' => 'Not Subject to CA Act',
				'name'  => 'not_subject_to_ca_act',
				'type'  => 'true_false',
			],
			[
				'key'   => 'is_new_product',
				'label' => 'Is New Product',
				'name'  => 'is_new_product',
				'type'  => 'true_false',
			],
			[
				'key'   => 'show_product_safer_choice_logo',
				'label' => 'Show Product Safer Choice Logo',
				'name'  => 'show_product_safer_choice_logo',
				'type'  => 'true_false',
			]
		];

		return $fields;
	}

	private static function register_proline() {
		acf_add_local_field_group(
			array(
				'key'                   => 'group_wpb_proline_product_meta',
				'title'                 => 'Proline Settings',
				'fields'                => self::get_proline_config(),
				'menu_order'            => 0,
				'position'              => 'side',
				'style'                 => 'default',
				'label_placement'       => 'top',
				'instruction_placement' => 'label',
				'active'                => true,
				'location'              => array(
					array(
						array(
							'param'    => 'post_taxonomy',
							'operator' => '==',
							'value'    => 'product_cat:proline',
						),
					),
				),
			)
		);
	}

	private static function get_proline_config() {
		$fields = [
			// Product Use Proline (True/False)
			[
				'key'     => 'product_use_proline',
				'label'   => 'Product Use Proline',
				'name'    => 'product_use_proline',
				'type'    => 'checkbox',
				'choices' => [
					'descalers_cleaners'        => 'Descalers & Cleaners',
					'stain_spot_removers'       => 'Stain & Spot Removers',
					'drain_maintainers_openers' => 'Drain Maintainers & Openers',
					'metal_cleaners'            => 'Metal Cleaners',
					'degreasers'                => 'Degreasers'
				]
			],
			[
				'key'     => 'field_product_application',
				'label'   => 'Product Application',
				'name'    => 'product_application',
				'type'    => 'checkbox',
				'choices' => [
					'facilities_maintenance' => 'Facilities Maintenance',
					'automotive'             => 'Automotive',
					'agriculture'            => 'Agriculture',
					'industrial'             => 'Industrial'
				]
			],
			// Product Type (Checkbox)
			[
				'key'     => 'product_type',
				'label'   => 'Product Type',
				'name'    => 'product_type',
				'type'    => 'checkbox',
				'choices' => [
					'routing_cleaning'         => 'Routing Cleaning',
					'preventative_maintenance' => 'Preventative Maintenance',
					'restorative'              => 'Restorative'
				]
			],
			// Show Proline Safer Choice (True/False)
			[
				'key'   => 'show_proline_safer_choice',
				'label' => 'Show Proline Safer Choice',
				'name'  => 'show_proline_safer_choice',
				'type'  => 'true_false',
			],
		];

		return $fields;
	}

	private static function setup_taxonomies(): void {
		WpbIngredient::setup();
		WpbAvailableSize::setup();
	}
}