<?php

namespace Wpb\Taxonomy;

class WpbAvailableSize {
	public static function setup(): void {
		self::register_available_sizes();
		self::register_available_size_meta();
	}

	public static function register_available_sizes(): void {
		register_taxonomy( 'available_size', 'product',
			array(
				'labels'            => array(
					'name'          => 'Available sizes',
					'singular_name' => 'Available size',
					'menu_name'     => 'Available sizes',
				),
				'hierarchical'      => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_in_rest'      => true,
				'rewrite'           => array( 'slug' => 'available-size' ),
			)
		);
	}

	public static function register_available_size_meta(): void {
		add_action( 'available_size_add_form_fields', array( __CLASS__, 'add_available_size_meta_fields' ) );
		add_action( 'available_size_edit_form_fields', array( __CLASS__, 'edit_available_size_meta_fields' ), 10, 2 );
		add_action( 'created_term', array( __CLASS__, 'set_available_size_meta_fields' ), 10, 3 );
		add_action( 'edited_term', array( __CLASS__, 'save_available_size_meta_fields' ), 10, 3 );
	}

	public static function add_available_size_meta_fields(): void {
		?>
		<div class="form-field">
			<label for="size_id">Size ID</label>
			<input type="text" name="size_id" id="size_id" value="">
		</div>
		<div class="form-field">
			<label for="display_order">Display Order</label>
			<input type="number" name="display_order" id="display_order" value="">
		</div>
		<?php
	}

	public static function edit_available_size_meta_fields( $tag, $taxonomy ): void {
		?>
		<tr class="form-field term-slug-wrap">
			<th scope="row"><label for="size_id">Size ID</label></th>
			<td><input type="text" name="size_id" id="size_id"
					   value="<?= get_term_meta( $tag->term_id, 'size_id', true ) ?>"></td>
		</tr>
		<tr class="form-field term-slug-wrap">
			<th scope="row"><label for="display_order">Display Order</label></th>
			<td><input type="number" name="display_order" id="display_order"
					   value="<?= get_term_meta( $tag->term_id, 'display_order', true ) ?>"></td>
		</tr>
		<?php
	}

	public static function set_available_size_meta_fields( $term_id, $tt_id, $taxonomy ): void {
		if ( isset( $_POST['size_id'] ) ) {
			$meta_value = sanitize_text_field( $_POST['size_id'] );
			add_term_meta( $term_id, 'size_id', $meta_value, true );
		}

		if ( isset( $_POST['display_order'] ) ) {
			$meta_value = sanitize_text_field( $_POST['display_order'] );
			add_term_meta( $term_id, 'display_order', $meta_value, true );
		}
	}

	public static function save_available_size_meta_fields( $term_id, $tt_id, $taxonomy ): void {
		if ( isset( $_POST['size_id'] ) ) {
			$meta_value = sanitize_text_field( $_POST['size_id'] );
			update_term_meta( $term_id, 'size_id', $meta_value );
		}

		if ( isset( $_POST['display_order'] ) ) {
			$meta_value = sanitize_text_field( $_POST['display_order'] );
			update_term_meta( $term_id, 'display_order', $meta_value );
		}
	}

	protected static function available_size_meta_config(): array {
		$fields = [
			[
				'key'   => 'size_id',
				'label' => 'Size Code (ID)',
				'name'  => 'size_id',
				'type'  => 'text',
			],
			[
				'key'   => 'size_order',
				'label' => 'Display Size Order',
				'name'  => 'size_order',
				'type'  => 'number',
			]
		];

		return $fields;
	}
}