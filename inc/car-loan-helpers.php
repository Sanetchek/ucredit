<?php
/**
 * Car loan helpers: defaults when ACF repeaters are empty.
 *
 * @package ucredit
 */

/**
 * Phone digits for tel:/wa.me links.
 *
 * @return string
 */
function ucredit_car_loan_phone_digits(): string {
	$href = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_phone_href' ) : '';
	if ( $href === '' ) {
		$href = '0505511992';
	}
	return preg_replace( '/\D+/', '', $href ) ?: '0505511992';
}

/**
 * Display phone string.
 *
 * @return string
 */
function ucredit_car_loan_phone_display(): string {
	$phone = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_phone' ) : '';
	return $phone !== '' ? $phone : '050-551-1992';
}

/**
 * Default hero chips.
 *
 * @return array<int, array{text: string}>
 */
function ucredit_car_loan_default_chips(): array {
	return array(
		array( 'text' => 'עד 100% משווי הרכב' ),
		array( 'text' => 'ללא ערבים' ),
		array( 'text' => 'גם לדירוג אשראי נמוך' ),
		array( 'text' => '12–100 תשלומים' ),
	);
}

/**
 * Default stats.
 *
 * @return array<int, array{value: string, label: string}>
 */
function ucredit_car_loan_default_stats(): array {
	return array(
		array( 'value' => '250K ₪', 'label' => 'סכום מקסימלי' ),
		array( 'value' => '98%', 'label' => 'אחוזי הצלחה ללקוחותינו' ),
		array( 'value' => '3 ימים', 'label' => 'מאישור עד הכסף בחשבון' ),
		array( 'value' => '1.2K', 'label' => 'לקוחות מרוצים' ),
	);
}

/**
 * Default process steps.
 *
 * @return array<int, array{title: string, text: string}>
 */
function ucredit_car_loan_default_steps(): array {
	return array(
		array(
			'title' => 'משאירים פרטים בטופס',
			'text'  => 'בדיקת זכאות ראשונית ללא עלות וללא פגיעה בדירוג האשראי.',
		),
		array(
			'title' => 'מעריכים את שווי הרכב',
			'text'  => 'לפי שנת ייצור, דגם וקילומטראז\' – וקובעים את הסכום המקסימלי.',
		),
		array(
			'title' => 'בוחרים סכום ותקופת החזר',
			'text'  => 'מציגים לכם את כל התנאים בשקיפות מלאה, לפני חתימה.',
		),
		array(
			'title' => 'הכסף בחשבון',
			'text'  => 'עד 3 ימי עסקים – והרכב ממשיך להיות שלכם ובשימושכם.',
		),
	);
}

/**
 * Default eligibility cards.
 *
 * @return array<int, array{title: string, text: string}>
 */
function ucredit_car_loan_default_elig_cards(): array {
	return array(
		array(
			'title' => 'בעלות על הרכב',
			'text'  => 'הרכב בבעלותכם המלאה, כולל רכבים שעברו שעבוד בעבר.',
		),
		array(
			'title' => 'שנת ייצור 2012 ומעלה',
			'text'  => 'כל סוגי הרכבים הפרטיים, וגם אופנועים ומשאיות.',
		),
		array(
			'title' => 'גיל 18 ומעלה',
			'text'  => 'שכירים, עצמאים ובעלי עסקים – לקוחות כל הבנקים.',
		),
		array(
			'title' => 'החזר גמיש',
			'text'  => '12–100 חודשים, ריבית קבועה או צמודה – לבחירתכם.',
		),
	);
}

/**
 * Default lead checklist.
 *
 * @return array<int, array{text: string}>
 */
function ucredit_car_loan_default_lead_checks(): array {
	return array(
		array( 'text' => 'בדיקה ללא פגיעה בדירוג האשראי' ),
		array( 'text' => 'ממשיכים לנהוג ברכב כרגיל' ),
		array( 'text' => 'חברה מחזיקת רישיון למתן שירותי אשראי' ),
	);
}

/**
 * Default FAQ items.
 *
 * @return array<int, array{question: string, answer: string}>
 */
function ucredit_car_loan_default_faq(): array {
	return array(
		array(
			'question' => 'מהי הלוואה כנגד שעבוד רכב?',
			'answer'   => 'הלוואה שבה הרכב שלכם משמש כבטוחה בלבד – ללא ערבים נוספים. הבעלות והשימוש ברכב נשארים אצלכם לכל אורך תקופת ההחזר.',
		),
		array(
			'question' => 'כמה כסף אפשר לקבל?',
			'answer'   => 'עד 100% משווי הרכב ועד 250,000 ₪, בהתאם לשווי הרכב ולחיווי הפיננסי שלכם.',
		),
		array(
			'question' => 'כמה זמן לוקח לקבל אישור?',
			'answer'   => 'אישור עקרוני מתקבל בדרך כלל תוך שעות מרגע קבלת המסמכים, והכסף מועבר לחשבון תוך עד 3 ימי עסקים.',
		),
		array(
			'question' => 'גם עם דירוג אשראי נמוך?',
			'answer'   => 'כן. הבטוחה מאפשרת לאשר בקשות שסורבו בבנק, כולל לבעלי דירוג אשראי נמוך.',
		),
	);
}

/**
 * Default footer legal links.
 *
 * @return array<int, array{link: array{url: string, title: string}}>
 */
function ucredit_car_loan_default_footer_links(): array {
	return array(
		array(
			'link' => array(
				'url'   => 'https://ucredit.co.il/%d7%94%d7%a6%d7%94%d7%a8%d7%aa-%d7%a0%d7%92%d7%99%d7%a9%d7%95%d7%aa/',
				'title' => 'הצהרת נגישות',
			),
		),
		array(
			'link' => array(
				'url'   => 'https://ucredit.co.il/%d7%9e%d7%93%d7%99%d7%a0%d7%99%d7%95%d7%aa-%d7%a4%d7%a8%d7%98%d7%99%d7%95%d7%aa/',
				'title' => 'מדיניות פרטיות',
			),
		),
		array(
			'link' => array(
				'url'   => 'https://ucredit.co.il/privacy-policy/',
				'title' => 'תקנון ותנאי שימוש',
			),
		),
	);
}

/**
 * Replace CF7 English blank select labels with Hebrew on the Car Loan template.
 *
 * Prefer updating the CF7 Form tab to use first_as_label (see docs/car-loan-cf7-form.md).
 * This is a fallback when include_blank is still used.
 *
 * @param string $content Form HTML.
 * @return string
 */
function ucredit_car_loan_cf7_hebrew_blank_options( string $content ): string {
	if ( ! function_exists( 'is_page_template' ) || ! is_page_template( 'templates/car-loan.php' ) ) {
		return $content;
	}

	$labels = array(
		'has-car'     => 'בחר/י',
		'loan-amount' => 'בחר/י סכום',
		'loan-term'   => 'בחר/י תקופה',
	);

	foreach ( $labels as $name => $label ) {
		$pattern = '/(<select[^>]*\bname=["\']' . preg_quote( $name, '/' ) . '["\'][^>]*>\s*<option[^>]*\bvalue=["\']["\'][^>]*>)(?:—Please choose an option—|&mdash;Please choose an option&mdash;|Please choose an option)(<\/option>)/iu';
		$content = (string) preg_replace( $pattern, '${1}' . $label . '${2}', $content );
	}

	$content = str_replace(
		array(
			'—Please choose an option—',
			'&mdash;Please choose an option&mdash;',
		),
		'בחר/י',
		$content
	);

	return $content;
}
add_filter( 'wpcf7_form_elements', 'ucredit_car_loan_cf7_hebrew_blank_options', 20 );

/**
 * Wrap the CF7 submit control so the spinner overlays the button
 * (car-loan form has no <p> around [submit], so absolute spinner otherwise
 * positions against a distant ancestor).
 *
 * @param string $content Form HTML.
 * @return string
 */
function ucredit_car_loan_cf7_wrap_submit( string $content ): string {
	if ( ! function_exists( 'is_page_template' ) || ! is_page_template( 'templates/car-loan.php' ) ) {
		return $content;
	}

	if ( str_contains( $content, 'car-loan-cf7-submit-wrap' ) ) {
		return $content;
	}

	$replaced = preg_replace(
		'/(<input\b[^>]*\bwpcf7-submit\b[^>]*>)/i',
		'<span class="car-loan-cf7-submit-wrap">$1</span>',
		$content,
		1
	);

	return is_string( $replaced ) ? $replaced : $content;
}
add_filter( 'wpcf7_form_elements', 'ucredit_car_loan_cf7_wrap_submit', 25 );

/**
 * Whether a CF7 form is the Car Loan lead form (by field tags, not form ID).
 *
 * @param mixed $contact_form WPCF7_ContactForm or null.
 * @return bool
 */
function ucredit_is_car_loan_contact_form( $contact_form ): bool {
	if ( ! is_object( $contact_form ) || ! method_exists( $contact_form, 'scan_form_tags' ) ) {
		return false;
	}

	$names = array();
	foreach ( (array) $contact_form->scan_form_tags() as $tag ) {
		if ( is_object( $tag ) && ! empty( $tag->name ) ) {
			$names[ (string) $tag->name ] = true;
		}
	}

	return isset( $names['has-car'], $names['loan-amount'], $names['loan-term'] );
}

/**
 * Map piped select / acceptance values to Hebrew display labels.
 *
 * @param string $field Field name.
 * @param string $value Raw posted / after-pipe value.
 * @return string
 */
function ucredit_car_loan_cf7_mail_display_value( string $field, string $value ): string {
	$value = sanitize_text_field( $value );

	if ( $field === 'has-car' ) {
		$map = array(
			'yes' => 'כן',
			'no'  => 'לא',
		);
		return $map[ strtolower( $value ) ] ?? $value;
	}

	if ( $field === 'loan-amount' ) {
		$map = array(
			'20'  => 'עד 20,000 ₪',
			'50'  => '20,000–50,000 ₪',
			'100' => '50,000–100,000 ₪',
			'250' => '100,000–250,000 ₪',
		);
		return $map[ $value ] ?? $value;
	}

	if ( $field === 'loan-term' ) {
		$map = array(
			'24'  => 'עד 24 חודשים',
			'60'  => '24–60 חודשים',
			'100' => '60–100 חודשים',
		);
		return $map[ $value ] ?? $value;
	}

	if ( $field === 'acceptance-consent' || $field === 'consent' ) {
		return $value !== '' ? 'כן' : 'לא';
	}

	return $value;
}

/**
 * Flatten a CF7 posted value to a string.
 *
 * @param mixed $value Posted field value.
 * @return string
 */
function ucredit_car_loan_cf7_flat_posted_value( $value ): string {
	if ( is_array( $value ) ) {
		$value = reset( $value );
	}
	if ( $value === null || $value === false ) {
		return '';
	}
	return sanitize_text_field( (string) $value );
}

/**
 * Build a multi-line plain-text mail body for the Car Loan CF7 lead.
 *
 * @param array<string, mixed> $posted Posted form data.
 * @return string
 */
function ucredit_car_loan_cf7_format_mail_body( array $posted ): string {
	$name  = ucredit_car_loan_cf7_flat_posted_value( $posted['your-name'] ?? '' );
	$phone = ucredit_car_loan_cf7_flat_posted_value( $posted['your-phone'] ?? '' );
	$has_car = ucredit_car_loan_cf7_mail_display_value(
		'has-car',
		ucredit_car_loan_cf7_flat_posted_value( $posted['has-car'] ?? '' )
	);
	$amount = ucredit_car_loan_cf7_mail_display_value(
		'loan-amount',
		ucredit_car_loan_cf7_flat_posted_value( $posted['loan-amount'] ?? '' )
	);
	$term = ucredit_car_loan_cf7_mail_display_value(
		'loan-term',
		ucredit_car_loan_cf7_flat_posted_value( $posted['loan-term'] ?? '' )
	);

	$consent_raw = $posted['acceptance-consent'] ?? ( $posted['consent'] ?? '' );
	$consent     = ucredit_car_loan_cf7_mail_display_value(
		'acceptance-consent',
		ucredit_car_loan_cf7_flat_posted_value( $consent_raw )
	);

	$site_title = function_exists( 'get_bloginfo' ) ? (string) get_bloginfo( 'name' ) : 'uCredit';
	$site_url   = function_exists( 'home_url' ) ? (string) home_url( '/' ) : '';

	$lines = array(
		'שם: ' . $name,
		'טלפון: ' . $phone,
		'האם יש רכב בבעלותך?: ' . $has_car,
		'סכום הלוואה: ' . $amount,
		'תקופת החזר: ' . $term,
		'הסכמה: ' . $consent,
		'',
		'--',
		sprintf(
			/* translators: 1: site name, 2: site URL */
			__( 'This e-mail was sent from a contact form on %1$s (%2$s)', 'ucredit' ),
			$site_title,
			$site_url
		),
	);

	return implode( "\n", $lines );
}

/**
 * Replace Car Loan CF7 mail body with a correctly mapped multi-line message.
 *
 * @param array<string, string> $components Mail components.
 * @param mixed                 $contact_form Contact form object.
 * @param mixed                 $mail         WPCF7_Mail instance.
 * @return array<string, string>
 */
function ucredit_car_loan_cf7_mail_components( $components, $contact_form, $mail = null ): array {
	if ( ! is_array( $components ) || ! ucredit_is_car_loan_contact_form( $contact_form ) ) {
		return is_array( $components ) ? $components : array();
	}

	$posted = array();
	if ( class_exists( 'WPCF7_Submission' ) ) {
		$submission = WPCF7_Submission::get_instance();
		if ( $submission ) {
			$posted = (array) $submission->get_posted_data();
		}
	}

	$plain = ucredit_car_loan_cf7_format_mail_body( $posted );

	$use_html = false;
	if ( is_object( $mail ) ) {
		try {
			$ref = new ReflectionProperty( $mail, 'use_html' );
			$ref->setAccessible( true );
			$use_html = (bool) $ref->getValue( $mail );
		} catch ( ReflectionException $e ) {
			$use_html = false;
		}
	}

	if ( $use_html ) {
		$components['body'] = nl2br( esc_html( $plain ), false );
	} else {
		$components['body'] = $plain;
	}

	return $components;
}
add_filter( 'wpcf7_mail_components', 'ucredit_car_loan_cf7_mail_components', 20, 3 );

/**
 * Lead.im credentials for the Car Loan CRM form.
 *
 * @return array{lm_form: int, lm_key: string}
 */
function ucredit_car_loan_lead_im_credentials(): array {
	return array(
		'lm_form' => 122910,
		'lm_key'  => '1f2d4303e0',
	);
}

/**
 * Build Lead.im POST body from Car Loan CF7 posted data.
 *
 * @param array<string, mixed> $posted      Posted form data.
 * @param string               $source_url Page URL (with UTMs when present).
 * @return array<string, string|int>
 */
function ucredit_car_loan_lead_im_payload( array $posted, string $source_url = '' ): array {
	$creds = ucredit_car_loan_lead_im_credentials();

	$name  = ucredit_car_loan_cf7_flat_posted_value( $posted['your-name'] ?? '' );
	$phone = ucredit_car_loan_cf7_flat_posted_value( $posted['your-phone'] ?? '' );
	$has_car = ucredit_car_loan_cf7_mail_display_value(
		'has-car',
		ucredit_car_loan_cf7_flat_posted_value( $posted['has-car'] ?? '' )
	);
	$amount = ucredit_car_loan_cf7_mail_display_value(
		'loan-amount',
		ucredit_car_loan_cf7_flat_posted_value( $posted['loan-amount'] ?? '' )
	);
	$term = ucredit_car_loan_cf7_mail_display_value(
		'loan-term',
		ucredit_car_loan_cf7_flat_posted_value( $posted['loan-term'] ?? '' )
	);

	$consent_raw = ucredit_car_loan_cf7_flat_posted_value(
		$posted['acceptance-consent'] ?? ( $posted['consent'] ?? '' )
	);
	$divur = $consent_raw !== '' ? 1 : 0;

	$payload = array(
		'lm_form'          => (int) $creds['lm_form'],
		'lm_key'           => (string) $creds['lm_key'],
		'lm_redirect'      => 'no',
		'name'             => function_exists( 'mb_substr' ) ? mb_substr( $name, 0, 300 ) : substr( $name, 0, 300 ),
		'phone'            => function_exists( 'mb_substr' ) ? mb_substr( $phone, 0, 300 ) : substr( $phone, 0, 300 ),
		'divur'            => $divur,
		'modal_loan_term'  => function_exists( 'mb_substr' ) ? mb_substr( $term, 0, 300 ) : substr( $term, 0, 300 ),
		'fld_286562'       => function_exists( 'mb_substr' ) ? mb_substr( $amount, 0, 300 ) : substr( $amount, 0, 300 ),
		'fld_333225'       => function_exists( 'mb_substr' ) ? mb_substr( $has_car, 0, 300 ) : substr( $has_car, 0, 300 ),
	);

	$source_url = esc_url_raw( $source_url );
	if ( $source_url !== '' ) {
		$payload['lm_source'] = function_exists( 'mb_substr' )
			? mb_substr( $source_url, 0, 3500 )
			: substr( $source_url, 0, 3500 );
	}

	return $payload;
}

/**
 * After Car Loan CF7 mail is sent, POST the lead to Lead.im CRM.
 *
 * @param mixed $contact_form WPCF7_ContactForm.
 */
function ucredit_car_loan_lead_im_submit( $contact_form ): void {
	if ( ! ucredit_is_car_loan_contact_form( $contact_form ) ) {
		return;
	}

	if ( ! class_exists( 'WPCF7_Submission' ) || ! function_exists( 'wp_remote_post' ) ) {
		return;
	}

	$submission = WPCF7_Submission::get_instance();
	if ( ! $submission ) {
		return;
	}

	$posted = (array) $submission->get_posted_data();
	$source = '';
	if ( method_exists( $submission, 'get_meta' ) ) {
		$source = (string) $submission->get_meta( 'url' );
	}

	$payload = ucredit_car_loan_lead_im_payload( $posted, $source );
	if ( $payload['name'] === '' || $payload['phone'] === '' ) {
		if ( function_exists( 'error_log' ) ) {
			error_log( 'ucredit car-loan CRM submit skipped: missing name or phone' );
		}
		return;
	}

	$body = http_build_query( $payload, '', '&', PHP_QUERY_RFC1738 );

	$response = wp_remote_post(
		'https://api.lead.im/v2/submit',
		array(
			'body'    => $body,
			'headers' => array( 'Content-Type' => 'application/x-www-form-urlencoded; charset=utf-8' ),
			'timeout' => 15,
		)
	);

	$code = (int) wp_remote_retrieve_response_code( $response );
	$raw  = (string) wp_remote_retrieve_body( $response );

	if ( $code < 200 || $code > 299 ) {
		if ( function_exists( 'error_log' ) ) {
			error_log( 'ucredit car-loan CRM submit failed: code=' . $code . ' body=' . $raw );
		}
	}
}
add_action( 'wpcf7_mail_sent', 'ucredit_car_loan_lead_im_submit' );

/**
 * Output Meta (Facebook) Pixel in <head> on the Car Loan landing only.
 */
function ucredit_car_loan_meta_pixel(): void {
	if ( ! function_exists( 'is_page_template' ) || ! is_page_template( 'templates/car-loan.php' ) ) {
		return;
	}

	$pixel_id = '1108644925026801';
	$noscript_src = 'https://www.facebook.com/tr?id=' . rawurlencode( $pixel_id ) . '&ev=PageView&noscript=1';
	?>
	<!-- Meta Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s)
	{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};
	if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
	n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];
	s.parentNode.insertBefore(t,s)}(window, document,'script',
	'https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '<?= esc_js( $pixel_id ); ?>');
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
		src="<?= esc_url( $noscript_src ); ?>"
		alt="" /></noscript>
	<!-- End Meta Pixel Code -->
	<?php
}
add_action( 'wp_head', 'ucredit_car_loan_meta_pixel', 20 );
