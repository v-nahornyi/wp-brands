<?php

namespace Clr\PostType;

class ClrNews extends ClrPostType {
	public static function setup(): void {
		self::register_news();
		self::register_news_meta();
	}

	public static function register_news(): void {
		$labels = array(
			'name'                  => __( 'News', 'clr-brands' ),
			'singular_name'         => __( 'News', 'clr-brands' ),
			'menu_name'             => __( 'News', 'clr-brands' ),
			'name_admin_bar'        => __( 'News', 'clr-brands' ),
			'add_new'               => __( 'Add New', 'clr-brands' ),
			'add_new_item'          => __( 'Add New News', 'clr-brands' ),
			'new_item'              => __( 'New News', 'clr-brands' ),
			'edit_item'             => __( 'Edit News', 'clr-brands' ),
			'view_item'             => __( 'View News', 'clr-brands' ),
			'all_items'             => __( 'All News', 'clr-brands' ),
			'search_items'          => __( 'Search News', 'clr-brands' ),
			'parent_item_colon'     => __( 'Parent News:', 'clr-brands' ),
			'not_found'             => __( 'No news found.', 'clr-brands' ),
			'not_found_in_trash'    => __( 'No news found in Trash.', 'clr-brands' ),
			'featured_image'        => _x( 'News Image', 'clr-brands' ),
			'set_featured_image'    => _x( 'Set news image', 'clr-brands' ),
			'remove_featured_image' => _x( 'Remove news image', 'clr-brands' ),
			'use_featured_image'    => _x( 'Use as news image', 'clr-brands' ),
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
			'menu_icon'          => 'dashicons-format-aside', // Dashicon
			'show_in_rest'       => true, // Enable Gutenberg editor
			'taxonomies'         => array( 'category', 'post_tag' ) // Assign categories and tags
		);

		register_post_type( 'news', $args );
	}

	public static function register_news_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_news_meta' ], - 1 );
	}

	public static function acf_add_news_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'group_clr_news_meta',
			'title'                 => 'News Settings',
			'fields'                => self::news_meta_config(),
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
						'value'    => 'news',
					),
				),
			),
		) );
	}

	protected static function news_meta_config(): array {
		$fields = [
			[
				'key'     => 'news_type',
				'label'   => 'Type',
				'name'    => 'news_type',
				'type'    => 'checkbox',
				'choices' => [],
			],
			[
				'key'   => 'news_source',
				'label' => 'News Source',
				'name'  => 'news_source',
				'type'  => 'text',
			],
			[
				'key'   => 'news_link',
				'label' => 'Link',
				'name'  => 'news_link',
				'type'  => 'link',
			],
			[
				'key'   => 'new_tab',
				'label' => 'Open news in a new tab',
				'name'  => 'new_tab',
				'type'  => 'true_false',
			]
		];

		return $fields;
	}
}