<?php
/**
 * ACF field group: Car Loan landing page.
 *
 * Location: page template templates/car-loan.php
 *
 * @package ucredit
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group(
	array(
		'key'                   => 'group_car_loan_landing',
		'title'                 => 'Car Loan Landing',
		'fields'                => array(
			// —— Header ——
			array(
				'key'   => 'field_car_loan_tab_header',
				'label' => 'Header',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_logo',
				'label'         => 'Logo',
				'name'          => 'car_loan_logo',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'medium',
			),
			array(
				'key'           => 'field_car_loan_phone',
				'label'         => 'Phone (display)',
				'name'          => 'car_loan_phone',
				'type'          => 'text',
				'default_value' => '050-551-1992',
			),
			array(
				'key'           => 'field_car_loan_phone_href',
				'label'         => 'Phone (tel: link digits)',
				'name'          => 'car_loan_phone_href',
				'type'          => 'text',
				'default_value' => '0505511992',
				'instructions'  => 'Digits only for tel: and WhatsApp links.',
			),
			array(
				'key'           => 'field_car_loan_header_cta',
				'label'         => 'Header CTA label',
				'name'          => 'car_loan_header_cta',
				'type'          => 'text',
				'default_value' => 'בדיקת זכאות חינם',
			),

			// —— Hero ——
			array(
				'key'   => 'field_car_loan_tab_hero',
				'label' => 'Hero',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_hero_eyebrow',
				'label'         => 'Eyebrow',
				'name'          => 'car_loan_hero_eyebrow',
				'type'          => 'text',
				'default_value' => 'הלוואה חוץ בנקאית כנגד שעבוד רכב',
			),
			array(
				'key'           => 'field_car_loan_hero_title',
				'label'         => 'Title',
				'name'          => 'car_loan_hero_title',
				'type'          => 'textarea',
				'rows'          => 2,
				'new_lines'     => 'br',
				'default_value' => "הרכב שלכם שווה\nעד 250,000 ₪ במזומן",
			),
			array(
				'key'           => 'field_car_loan_hero_text',
				'label'         => 'Description',
				'name'          => 'car_loan_hero_text',
				'type'          => 'textarea',
				'rows'          => 4,
				'default_value' => 'מקבלים עד 100% משווי הרכב, בלי ערבים ובלי בירוקרטיה – והרכב נשאר אצלכם וממשיך לנסוע כרגיל. אישור עקרוני מהיר, תנאים אישיים והכסף בחשבון תוך 3 ימי עסקים.',
			),
			array(
				'key'           => 'field_car_loan_hero_cta_primary',
				'label'         => 'Primary CTA label',
				'name'          => 'car_loan_hero_cta_primary',
				'type'          => 'text',
				'default_value' => 'קבלו הצעה תוך דקות',
			),
			array(
				'key'           => 'field_car_loan_hero_cta_whatsapp',
				'label'         => 'WhatsApp CTA label',
				'name'          => 'car_loan_hero_cta_whatsapp',
				'type'          => 'text',
				'default_value' => 'דברו איתנו בוואטסאפ',
			),
			array(
				'key'          => 'field_car_loan_hero_chips',
				'label'        => 'Benefit chips',
				'name'         => 'car_loan_hero_chips',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add chip',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_hero_chip_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'           => 'field_car_loan_hero_image',
				'label'         => 'Hero image',
				'name'          => 'car_loan_hero_image',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'medium',
				'instructions'  => 'Optional. Falls back to Media Library URL if empty (upload recommended).',
			),

			// —— Stats ——
			array(
				'key'   => 'field_car_loan_tab_stats',
				'label' => 'Stats',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'          => 'field_car_loan_stats',
				'label'        => 'Stats',
				'name'         => 'car_loan_stats',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add stat',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_stat_value',
						'label' => 'Value',
						'name'  => 'value',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_car_loan_stat_label',
						'label' => 'Label',
						'name'  => 'label',
						'type'  => 'text',
					),
				),
			),

			// —— Process ——
			array(
				'key'   => 'field_car_loan_tab_process',
				'label' => 'Process',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_process_eyebrow',
				'label'         => 'Eyebrow',
				'name'          => 'car_loan_process_eyebrow',
				'type'          => 'text',
				'default_value' => 'תנאים מיוחדים ובדיקת זכאות ללא עלות!',
			),
			array(
				'key'           => 'field_car_loan_process_title',
				'label'         => 'Title',
				'name'          => 'car_loan_process_title',
				'type'          => 'text',
				'default_value' => 'איך זה עובד – 4 שלבים פשוטים',
			),
			array(
				'key'           => 'field_car_loan_process_text',
				'label'         => 'Description',
				'name'          => 'car_loan_process_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'כל התהליך דיגיטלי, מלווה בנציג אישי, וללא התחייבות עד שתאשרו את התנאים.',
			),
			array(
				'key'          => 'field_car_loan_process_steps',
				'label'        => 'Steps',
				'name'         => 'car_loan_process_steps',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add step',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_process_step_title',
						'label' => 'Title',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_car_loan_process_step_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'textarea',
						'rows'  => 2,
					),
				),
			),
			array(
				'key'           => 'field_car_loan_process_cta',
				'label'         => 'CTA label',
				'name'          => 'car_loan_process_cta',
				'type'          => 'text',
				'default_value' => 'לבדיקת זכאות מהירה',
			),
			array(
				'key'           => 'field_car_loan_process_image',
				'label'         => 'Process image',
				'name'          => 'car_loan_process_image',
				'type'          => 'image',
				'return_format' => 'id',
				'preview_size'  => 'medium',
			),

			// —— Eligibility ——
			array(
				'key'   => 'field_car_loan_tab_eligibility',
				'label' => 'Eligibility',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_elig_title',
				'label'         => 'Title',
				'name'          => 'car_loan_elig_title',
				'type'          => 'text',
				'default_value' => 'מי יכול לקבל?',
			),
			array(
				'key'           => 'field_car_loan_elig_text',
				'label'         => 'Description',
				'name'          => 'car_loan_elig_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'התנאים הבסיסיים לשעבוד רכב ב-UCredit. גם אם קיבלתם סירוב מהבנק – שווה לבדוק.',
			),
			array(
				'key'          => 'field_car_loan_elig_cards',
				'label'        => 'Cards',
				'name'         => 'car_loan_elig_cards',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add card',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_elig_card_title',
						'label' => 'Title',
						'name'  => 'title',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_car_loan_elig_card_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'textarea',
						'rows'  => 2,
					),
				),
			),

			// —— Banks ——
			array(
				'key'   => 'field_car_loan_tab_banks',
				'label' => 'Banks',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_show_banks',
				'label'         => 'Show banks section',
				'name'          => 'car_loan_show_banks',
				'type'          => 'true_false',
				'default_value' => 1,
				'ui'            => 1,
			),
			array(
				'key'               => 'field_car_loan_banks_eyebrow',
				'label'             => 'Eyebrow',
				'name'              => 'car_loan_banks_eyebrow',
				'type'              => 'text',
				'default_value'     => 'עובדים עם כל גופי המימון הגדולים',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_car_loan_show_banks',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			),
			array(
				'key'               => 'field_car_loan_banks_title',
				'label'             => 'Title',
				'name'              => 'car_loan_banks_title',
				'type'              => 'text',
				'default_value'     => 'ההלוואה ניתנת ללקוחות כל הבנקים',
				'conditional_logic' => array(
					array(
						array(
							'field'    => 'field_car_loan_show_banks',
							'operator' => '==',
							'value'    => '1',
						),
					),
				),
			),

			// —— Lead / CF7 ——
			array(
				'key'   => 'field_car_loan_tab_lead',
				'label' => 'Lead form',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_lead_title',
				'label'         => 'Title',
				'name'          => 'car_loan_lead_title',
				'type'          => 'text',
				'default_value' => 'בדיקת זכאות חינם – בלי התחייבות',
			),
			array(
				'key'           => 'field_car_loan_lead_text',
				'label'         => 'Description',
				'name'          => 'car_loan_lead_text',
				'type'          => 'textarea',
				'rows'          => 3,
				'default_value' => 'השאירו פרטים ונציג יחזור אליכם עם הצעה אישית להלוואה כנגד שעבוד רכב – עד 250,000 ₪, אישור מיידי, הכסף תוך 3 ימי עסקים.',
			),
			array(
				'key'          => 'field_car_loan_lead_checks',
				'label'        => 'Checklist items',
				'name'         => 'car_loan_lead_checks',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add item',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_lead_check_text',
						'label' => 'Text',
						'name'  => 'text',
						'type'  => 'text',
					),
				),
			),
			array(
				'key'           => 'field_car_loan_form_title',
				'label'         => 'Form card title',
				'name'          => 'car_loan_form_title',
				'type'          => 'text',
				'default_value' => 'בקשת זכאות להלוואה',
			),
			array(
				'key'           => 'field_car_loan_form_subtitle',
				'label'         => 'Form card subtitle',
				'name'          => 'car_loan_form_subtitle',
				'type'          => 'text',
				'default_value' => 'מלאו את הפרטים – זה לוקח פחות מדקה.',
			),
			array(
				'key'           => 'field_car_loan_cf7_shortcode',
				'label'         => 'Contact Form 7 shortcode',
				'name'          => 'car_loan_cf7_shortcode',
				'type'          => 'text',
				'instructions'  => 'Paste the Car form shortcode, e.g. [contact-form-7 id="xxx" title="Car"]',
				'placeholder'   => '[contact-form-7 id="" title="Car"]',
			),
			array(
				'key'           => 'field_car_loan_form_disclaimer',
				'label'         => 'Form disclaimer',
				'name'          => 'car_loan_form_disclaimer',
				'type'          => 'text',
				'default_value' => 'הפנייה אינה מהווה התחייבות לקבלת אשראי.',
			),

			// —— FAQ ——
			array(
				'key'   => 'field_car_loan_tab_faq',
				'label' => 'FAQ',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_faq_title',
				'label'         => 'Title',
				'name'          => 'car_loan_faq_title',
				'type'          => 'text',
				'default_value' => 'שאלות נפוצות',
			),
			array(
				'key'          => 'field_car_loan_faq_items',
				'label'        => 'Questions',
				'name'         => 'car_loan_faq_items',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add question',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_faq_q',
						'label' => 'Question',
						'name'  => 'question',
						'type'  => 'text',
					),
					array(
						'key'   => 'field_car_loan_faq_a',
						'label' => 'Answer',
						'name'  => 'answer',
						'type'  => 'textarea',
						'rows'  => 3,
					),
				),
			),

			// —— Footer ——
			array(
				'key'   => 'field_car_loan_tab_footer',
				'label' => 'Footer',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'          => 'field_car_loan_footer_links',
				'label'        => 'Legal links',
				'name'         => 'car_loan_footer_links',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add link',
				'sub_fields'   => array(
					array(
						'key'   => 'field_car_loan_footer_link',
						'label' => 'Link',
						'name'  => 'link',
						'type'  => 'link',
					),
				),
			),
			array(
				'key'           => 'field_car_loan_footer_disclosure',
				'label'         => 'Legal disclosure',
				'name'          => 'car_loan_footer_disclosure',
				'type'          => 'textarea',
				'rows'          => 6,
				'default_value' => 'גילוי נאות: ההלוואות ניתנות ללקוחות כל הבנקים, מעל גיל 18. תקופת ההלוואה 12–100 חודשים. הריבית השנתית נקבעת בהתאם לחיווי הפיננסי של מבקש ההלוואה. קבלת האשראי מותנית בהגשת בקשה, ומועמדת לפי שיקול דעתו המוחלט של הגורם המלווה ובכפוף לתנאיו. הפרסום אינו מהווה הצעה למתן אשראי. אי עמידה בפירעון ההלוואה עלולה לגרור חיוב בריבית פיגורים והליכי הוצאה לפועל, ובהלוואה כנגד שעבוד רכב – מימוש השעבוד. לשם בחינת הבקשה, הגורם המממן רשאי לפנות ללשכת אשראי לקבלת חיווי אשראי לגביך, ולשכת האשראי תגיש לבנק ישראל בקשה לקבלת נתוני האשראי הכלולים במאגר נתוני אשראי לגביך.',
			),
			array(
				'key'           => 'field_car_loan_footer_copy',
				'label'         => 'Copyright',
				'name'          => 'car_loan_footer_copy',
				'type'          => 'text',
				'default_value' => '© כל הזכויות שמורות ל-יוקרדיט 2026 · UCredit — הלוואה לכל מטרה',
			),

			// —— Mobile bar ——
			array(
				'key'   => 'field_car_loan_tab_mobile',
				'label' => 'Mobile bar',
				'name'  => '',
				'type'  => 'tab',
			),
			array(
				'key'           => 'field_car_loan_mobile_cta',
				'label'         => 'Mobile CTA label',
				'name'          => 'car_loan_mobile_cta',
				'type'          => 'text',
				'default_value' => 'קבלו הצעה תוך דקות',
			),
		),
		'location'              => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'templates/car-loan.php',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'active'                => true,
	)
);
