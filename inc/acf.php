<?php
/**
 * ACF options pages, local field groups, and JSON sync.
 *
 * @package ucredit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Save ACF field groups into the theme so they can be committed and synced.
 *
 * @param string $path Default save path.
 * @return string
 */
function ucredit_acf_json_save_path( $path ) {
	return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'ucredit_acf_json_save_path' );

/**
 * Load ACF field groups from the theme JSON directory.
 *
 * @param array<int, string> $paths Load paths.
 * @return array<int, string>
 */
function ucredit_acf_json_load_paths( $paths ) {
	unset( $paths[0] );

	$paths[] = get_stylesheet_directory() . '/acf-json';

	return $paths;
}
add_filter( 'acf/settings/load_json', 'ucredit_acf_json_load_paths' );

// Create Theme Options Page
if ( function_exists( 'acf_add_options_page' ) ) {
	acf_add_options_page( array(
		'page_title'  => 'uCredit Settings',
		'menu_title'  => 'uCredit Settings',
		'menu_slug'   => 'ucredit-general-settings',
		'position'   => 2,
		'capability' => 'edit_posts',
		'icon_url'   => 'dashicons-admin-generic',
		'redirect'   => false,
	) );

	// Loan Wizard sub-page
	acf_add_options_page( array(
		'page_title'  => 'Loan Wizard Settings',
		'menu_title'  => 'Loan Wizard',
		'menu_slug'   => 'ucredit-wizard-settings',
		'parent_slug' => 'ucredit-general-settings',
		'capability'  => 'edit_posts',
	) );
}

/**
 * ACF Options: Loan Wizard popup texts
 * All wizard strings are editable from uCredit Settings → Loan Wizard (sub-page).
 */
if ( function_exists( 'acf_add_local_field_group' ) ) {
	acf_add_local_field_group( array(
		'key'                   => 'group_wizard_options',
		'title'                 => 'Loan Wizard (Popup)',
		'fields'                => array(
			array(
				'key'   => 'field_wizard_tab_general',
				'label' => 'Header & Success',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_wizard_brand',
				'label'         => 'Brand name',
				'name'          => 'wizard_brand',
				'type'          => 'text',
				'default_value' => 'UCREDIT',
			),
			array(
				'key'           => 'field_wizard_tagline',
				'label'         => 'Tagline',
				'name'          => 'wizard_tagline',
				'type'          => 'text',
				'default_value' => 'הלוואה מהירה לכל מטרה',
			),
			array(
				'key'           => 'field_wizard_success_title',
				'label'         => 'Success overlay title',
				'name'          => 'wizard_success_title',
				'type'          => 'text',
				'default_value' => 'תודה רבה!',
			),
			array(
				'key'           => 'field_wizard_success_line1',
				'label'         => 'Success text line 1',
				'name'          => 'wizard_success_line1',
				'type'          => 'text',
				'default_value' => 'הפרטים התקבלו בהצלחה',
			),
			array(
				'key'           => 'field_wizard_success_line2',
				'label'         => 'Success text line 2',
				'name'          => 'wizard_success_line2',
				'type'          => 'text',
				'default_value' => 'נחזור אליכם בהקדם האפשרי',
			),
			array(
				'key'           => 'field_wizard_back_btn',
				'label'         => 'Back button text',
				'name'          => 'wizard_back_btn',
				'type'          => 'text',
				'default_value' => 'חזור',
			),
			array(
				'key'           => 'field_wizard_submit_btn',
				'label'         => 'Submit button text',
				'name'          => 'wizard_submit_btn',
				'type'          => 'text',
				'default_value' => 'בדיקת התאמה חינם',
			),
			array(
				'key'           => 'field_wizard_emails',
				'label'         => 'Email recipients',
				'name'          => 'wizard_emails',
				'type'          => 'textarea',
				'instructions'   => 'Comma-separated list of email addresses to receive form submissions. Example: admin@site.com, manager@site.com',
				'rows'          => 3,
				'placeholder'   => 'email1@example.com, email2@example.com',
			),
			array(
				'key'           => 'field_wizard_email_subject',
				'label'         => 'Email subject',
				'name'          => 'wizard_email_subject',
				'type'          => 'text',
				'default_value' => 'New loan wizard submission - UCREDIT',
				'placeholder'   => 'New loan wizard submission',
			),
			array(
				'key'           => 'field_wizard_crm_form',
				'label'         => 'Lead.im Form ID (lm_form)',
				'name'          => 'wizard_crm_form',
				'type'          => 'number',
				'default_value' => 109567,
				'instructions'  => 'Lead.im Form ID (lm_form). Used when submitting leads to CRM.',
			),
			array(
				'key'           => 'field_wizard_crm_key',
				'label'         => 'Lead.im API key (lm_key)',
				'name'          => 'wizard_crm_key',
				'type'          => 'text',
				'maxlength'     => 10,
				'default_value' => 'c55bdb9161',
				'instructions'  => 'Lead.im API key (lm_key). Leave empty to disable CRM submit.',
			),
			array(
				'key'   => 'field_wizard_tab_steps',
				'label' => 'Steps 1 & 2',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_wizard_step1_title',
				'label'         => 'Step 1 title',
				'name'          => 'wizard_step1_title',
				'type'          => 'text',
				'default_value' => 'עבור מה אתם צריכים הלוואה?',
			),
			array(
				'key'           => 'field_wizard_step1_subtitle',
				'label'         => 'Step 1 subtitle',
				'name'          => 'wizard_step1_subtitle',
				'type'          => 'text',
				'default_value' => 'עוזר לנו להתאים את ההצעה – לא מחייב',
			),
			array(
				'key'         => 'field_wizard_step1_options',
				'label'       => 'Step 1 options (loan purpose)',
				'name'        => 'wizard_step1_options',
				'type'        => 'repeater',
				'layout'      => 'table',
				'sub_fields'  => array(
					array(
						'key'   => 'field_wizard_step1_opt_value',
						'label' => 'Value (slug)',
						'name'  => 'value',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_wizard_step1_opt_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'           => 'field_wizard_step2_title',
				'label'         => 'Step 2 title',
				'name'          => 'wizard_step2_title',
				'type'          => 'text',
				'default_value' => 'איזה סדר גודל של סכום רלוונטי לכם?',
			),
			array(
				'key'           => 'field_wizard_step2_subtitle',
				'label'         => 'Step 2 subtitle',
				'name'          => 'wizard_step2_subtitle',
				'type'          => 'text',
				'default_value' => 'אפשר לשנות את הסכום בהמשך',
			),
			array(
				'key'         => 'field_wizard_step2_options',
				'label'       => 'Step 2 options (loan amount)',
				'name'        => 'wizard_step2_options',
				'type'        => 'repeater',
				'layout'      => 'table',
				'sub_fields'  => array(
					array(
						'key'   => 'field_wizard_step2_opt_value',
						'label' => 'Value (slug)',
						'name'  => 'value',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_wizard_step2_opt_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'   => 'field_wizard_tab_step3',
				'label' => 'Step 3 (form)',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_wizard_step3_title',
				'label'         => 'Step 3 title',
				'name'          => 'wizard_step3_title',
				'type'          => 'text',
				'default_value' => 'מצאנו כיוון שמתאים לכם',
			),
			array(
				'key'           => 'field_wizard_step3_subtitle',
				'label'         => 'Step 3 subtitle',
				'name'          => 'wizard_step3_subtitle',
				'type'          => 'text',
				'default_value' => 'השאירו פרטים ונחזור אליכם עם הצעה מותאמת',
			),
			array(
				'key'           => 'field_wizard_placeholder_name',
				'label'         => 'Name input placeholder',
				'name'          => 'wizard_placeholder_name',
				'type'          => 'text',
				'default_value' => 'שם מלא',
			),
			array(
				'key'           => 'field_wizard_placeholder_phone',
				'label'         => 'Phone input placeholder',
				'name'          => 'wizard_placeholder_phone',
				'type'          => 'text',
				'default_value' => 'טלפון ליצירת קשר (ללא התחייבות)',
			),
			array(
				'key'           => 'field_wizard_trust_1',
				'label'         => 'Trust line 1',
				'name'          => 'wizard_trust_1',
				'type'          => 'text',
				'default_value' => 'פרטים נשמרים בדיסקרטיות מלאה',
			),
			array(
				'key'           => 'field_wizard_trust_2',
				'label'         => 'Trust line 2',
				'name'          => 'wizard_trust_2',
				'type'          => 'text',
				'default_value' => 'חזרה מהירה',
			),
			array(
				'key'           => 'field_wizard_trust_3',
				'label'         => 'Trust line 3',
				'name'          => 'wizard_trust_3',
				'type'          => 'text',
				'default_value' => 'ללא התחייבות',
			),
			array(
				'key'           => 'field_wizard_consent_text',
				'label'         => 'Consent checkbox text',
				'name'          => 'wizard_consent_text',
				'type'          => 'text',
				'default_value' => 'אני מאשר/ת יצירת קשר בהתאם לתנאי השימוש ומדיניות הפרטיות',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'options_page',
					'operator' => '==',
					'value'    => 'ucredit-wizard-settings',
				),
			),
		),
	) );
}

require get_template_directory() . '/inc/acf-car-loan.php';

