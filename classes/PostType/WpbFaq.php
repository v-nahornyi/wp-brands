<?php

namespace Wpb\PostType;

class WpbFaq extends WpbPostType {
	public static function setup(): void {
		self::register_faq();
	}

	public static function register_faq(): void {
		$labels = array(
			'name'               => __( 'FAQ', 'wpb-brands' ),
			'singular_name'      => __( 'FAQ', 'wpb-brands' ),
			'menu_name'          => __( 'FAQs', 'wpb-brands' ),
			'name_admin_bar'     => __( 'FAQs', 'wpb-brands' ),
			'add_new'            => __( 'Add New FAQ', 'wpb-brands' ),
			'add_new_item'       => __( 'Add New FAQ', 'wpb-brands' ),
			'new_item'           => __( 'New FAQ', 'wpb-brands' ),
			'edit_item'          => __( 'Edit FAQ', 'wpb-brands' ),
			'view_item'          => __( 'View FAQ', 'wpb-brands' ),
			'all_items'          => __( 'All FAQs', 'wpb-brands' ),
			'search_items'       => __( 'Search FAQs', 'wpb-brands' ),
			'parent_item_colon'  => __( 'Parent FAQs:', 'wpb-brands' ),
			'not_found'          => __( 'No FAQs found.', 'wpb-brands' ),
			'not_found_in_trash' => __( 'No FAQs found in Trash.', 'wpb-brands' ),
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
			'menu_icon'          => 'dashicons-search',
			'show_in_rest'       => true,
		);

		register_post_type( 'faq', $args );
	}
}