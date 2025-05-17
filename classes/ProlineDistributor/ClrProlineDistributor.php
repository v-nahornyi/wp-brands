<?php

namespace Clr\ProlineDistributor;

class ClrProlineDistributor {
	public static function setup(): void {
		self::register_user_acf_meta();
	}
	
	private static function register_user_acf_meta(): void {
		add_action( 'acf/init', [ __CLASS__, 'acf_add_proline_distributor_meta' ], - 1 );
	}
	
	public static function acf_add_proline_distributor_meta(): void {
		acf_add_local_field_group( array(
			'key'                   => 'clr_proline_distributor_meta',
			'title'                 => 'Pro Distributors Settings',
			'fields'                => self::proline_distributor_meta_config(),
			'menu_order'            => 0,
			'position'              => 'normal',
			'style'                 => 'default',
			'label_placement'       => 'top',
			'instruction_placement' => 'label',
			'active'                => true,
			'location' => array(
				array(
					array(
						'param' => 'user_form',
						'operator' => '==',
						'value' => 'all',
					),
				),
			),
		) );
	}
	
	private static function proline_distributor_meta_config(): array {
		$fields = [

			[
				'key'   => 'proline_dist_company',
				'label' => __( 'Company', 'clr-brands' ),
				'name'  => 'proline_dist_company',
				'type'  => 'text',
			],
			[
				'key'   => 'proline_dist_phone',
				'label' => __( 'Phone Number', 'clr-brands' ),
				'name'  => 'proline_dist_phone',
				'type'  => 'text',
			],
			[
				'key'   => 'proline_dist_city',
				'label' => __( 'City', 'clr-brands' ),
				'name'  => 'proline_dist_city',
				'type'  => 'text',
			],
			[
				'key'   => 'proline_dist_state',
				'label' => __( 'State', 'clr-brands' ),
				'name'  => 'proline_dist_state',
				'type'  => 'text',
			],
			[
				'key'   => 'calcium_lime_rust_remover',
				'label' => __( 'Calcium Lime Rust Remover', 'clr-brands' ),
				'name'  => 'calcium_lime_rust_remover',
				'type'  => 'true_false',
			],
			[
				'key'   => 'drain_maintainer',
				'label' => __( 'Drain Maintainer', 'clr-brands' ),
				'name'  => 'drain_maintainer',
				'type'  => 'true_false',
			],
			[
				'key'   => 'commercial_probiotic_cleaner',
				'label' => __( 'Commercial Probiotic Cleaner', 'clr-brands' ),
				'name'  => 'commercial_probiotic_cleaner',
				'type'  => 'true_false',
			],
			[
				'key'   => 'exterior_rust_remover',
				'label' => __( 'Exterior Rust Remover', 'clr-brands' ),
				'name'  => 'exterior_rust_remover',
				'type'  => 'true_false',
			],
			[
				'key'   => 'heavy_duty_cleaner_degreaser',
				'label' => __( 'Heavy Duty Cleaner Degreaser', 'clr-brands' ),
				'name'  => 'heavy_duty_cleaner_degreaser',
				'type'  => 'true_false',
			],
			[
				'key'   => 'heavy_duty_radiator_flush_cleaner',
				'label' => __( 'Heavy Duty Radiator Flush Cleaner', 'clr-brands' ),
				'name'  => 'heavy_duty_radiator_flush_cleaner',
				'type'  => 'true_false',
			],
			[
				'key'   => 'industrial_systems_flush',
				'label' => __( 'Industrial Systems Flush', 'clr-brands' ),
				'name'  => 'industrial_systems_flush',
				'type'  => 'true_false',
			],
			[
				'key'   => 'mold_mildew_stain_remover',
				'label' => __( 'Mold Mildew Stain Remover', 'clr-brands' ),
				'name'  => 'mold_mildew_stain_remover',
				'type'  => 'true_false',
			],
			[
				'key'   => 'multi_purpose_cleaner',
				'label' => __( 'Multi Purpose Cleaner', 'clr-brands' ),
				'name'  => 'multi_purpose_cleaner',
				'type'  => 'true_false',
			],
			[
				'key'   => 'restroom_cleaner',
				'label' => __( 'Restroom Cleaner', 'clr-brands' ),
				'name'  => 'restroom_cleaner',
				'type'  => 'true_false',
			],
			[
				'key'   => 'vehicle_lime_remover',
				'label' => __( 'Vehicle Lime Remover', 'clr-brands' ),
				'name'  => 'vehicle_lime_remover',
				'type'  => 'true_false',
			],
			[
				'key'   => 'tarn_x_tarnish_remover',
				'label' => __( 'Tarn X Tarnish Remover', 'clr-brands' ),
				'name'  => 'tarn_x_tarnish_remover',
				'type'  => 'true_false',
			],
			[
				'key'   => 'preferred_distributor',
				'label' => __( 'Preferred Distributor', 'clr-brands' ),
				'name'  => 'preferred_distributor',
				'type'  => 'text',
			],
			[
				'key'   => 'form_notes',
				'label' => __( 'Notes', 'clr-brands' ),
				'name'  => 'form_notes',
				'type'  => 'textarea',
			],
			[
				'key'   => 'proline_distributor_consent_agreement',
				'label' => __( 'Proline distributor consent agreement', 'clr-brands' ),
				'name'  => 'proline_distributor_consent_agreement',
				'type'  => 'text',
			],
			[
				'key'   => 'consent_agreement',
				'label' => __( 'Consent agreement', 'clr-brands' ),
				'name'  => 'consent_agreement',
				'type'  => 'text',
			],
			[
				'key'   => 'proline_distributor_id',
				'label' => __( 'Proline Distributor ID', 'clr-brands' ),
				'name'  => 'proline_distributor_id',
				'type'  => 'number',
			],
		];

		return $fields;
	}
}