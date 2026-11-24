<?php
/**
 * Smoke tests: Car Loan landing template wiring.
 *
 * Run: php tests/smoke/CarLoanLandingTest.php
 *
 * @package ucredit
 */

declare(strict_types=1);

$failed = 0;
$theme_root = dirname( __DIR__, 2 );

/**
 * @param bool   $cond Condition.
 * @param string $msg  Message.
 */
function car_loan_smoke_assert( bool $cond, string $msg ): void {
	global $failed;
	if ( $cond ) {
		echo "OK  {$msg}\n";
		return;
	}
	++$failed;
	fwrite( STDERR, "FAIL {$msg}\n" );
}

$required_files = array(
	'templates/car-loan.php',
	'inc/acf-car-loan.php',
	'inc/car-loan-helpers.php',
	'assets/scss/car-loan.scss',
	'assets/img/Ucredit_logo_Hebrew.png',
	'template-parts/car-loan/header.php',
	'template-parts/car-loan/hero.php',
	'template-parts/car-loan/stats.php',
	'template-parts/car-loan/process.php',
	'template-parts/car-loan/eligibility.php',
	'template-parts/car-loan/banks.php',
	'template-parts/car-loan/lead.php',
	'template-parts/car-loan/faq.php',
	'template-parts/car-loan/footer.php',
	'template-parts/car-loan/mobile-bar.php',
);

foreach ( $required_files as $rel ) {
	car_loan_smoke_assert(
		is_file( $theme_root . '/' . $rel ),
		"file exists: {$rel}"
	);
}

$template = (string) file_get_contents( $theme_root . '/templates/car-loan.php' );
car_loan_smoke_assert(
	false !== strpos( $template, 'Template Name: Car Loan' ),
	'template declares Template Name: Car Loan'
);
car_loan_smoke_assert(
	false !== strpos( $template, "get_template_part( 'template-parts/car-loan/lead'" ),
	'template loads lead partial'
);

$acf = (string) file_get_contents( $theme_root . '/inc/acf-car-loan.php' );
car_loan_smoke_assert(
	false !== strpos( $acf, 'car_loan_cf7_shortcode' ),
	'ACF registers car_loan_cf7_shortcode'
);
car_loan_smoke_assert(
	false !== strpos( $acf, 'templates/car-loan.php' ),
	'ACF location targets car-loan template'
);
car_loan_smoke_assert(
	false !== strpos( $acf, 'group_car_loan_landing' ),
	'ACF group key present'
);

$acf_bootstrap = (string) file_get_contents( $theme_root . '/inc/acf.php' );
car_loan_smoke_assert(
	false !== strpos( $acf_bootstrap, 'acf-car-loan.php' ),
	'acf.php requires acf-car-loan.php'
);
car_loan_smoke_assert(
	is_dir( $theme_root . '/acf-json' ),
	'acf-json directory exists for local JSON'
);
car_loan_smoke_assert(
	false !== strpos( $acf_bootstrap, "add_filter( 'acf/settings/save_json', 'ucredit_acf_json_save_path' )" ),
	'acf.php saves field groups to acf-json'
);
car_loan_smoke_assert(
	false !== strpos( $acf_bootstrap, "add_filter( 'acf/settings/load_json', 'ucredit_acf_json_load_paths' )" ),
	'acf.php loads field groups from acf-json'
);
car_loan_smoke_assert(
	false !== strpos( $acf_bootstrap, "unset( \$paths[0] )" ),
	'acf.php replaces the default JSON load path'
);

$functions = (string) file_get_contents( $theme_root . '/functions.php' );
car_loan_smoke_assert(
	false !== strpos( $functions, 'car-loan-helpers.php' ),
	'functions.php requires car-loan-helpers.php'
);

$header = (string) file_get_contents( $theme_root . '/header.php' );
car_loan_smoke_assert(
	false !== strpos( $header, 'templates/car-loan.php' ),
	'header.php hides masthead for car-loan'
);

$footer = (string) file_get_contents( $theme_root . '/footer.php' );
car_loan_smoke_assert(
	false !== strpos( $footer, 'templates/car-loan.php' ),
	'footer.php skips site chrome for car-loan'
);

$style = (string) file_get_contents( $theme_root . '/assets/style-rtl.scss' );
car_loan_smoke_assert(
	false !== strpos( $style, "scss/car-loan" ),
	'style-rtl.scss imports car-loan'
);

$helpers = (string) file_get_contents( $theme_root . '/inc/car-loan-helpers.php' );
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_phone_digits' ),
	'helpers define ucredit_car_loan_phone_digits'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_default_faq' ),
	'helpers define default FAQ'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_cf7_wrap_submit' ),
	'helpers define CF7 submit wrap for spinner overlay'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_is_car_loan_contact_form' ),
	'helpers define ucredit_is_car_loan_contact_form'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_cf7_format_mail_body' ),
	'helpers define ucredit_car_loan_cf7_format_mail_body'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_cf7_mail_components' ),
	'helpers define ucredit_car_loan_cf7_mail_components'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, "add_filter( 'wpcf7_mail_components'" ),
	'helpers hook wpcf7_mail_components for car-loan mail body'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_meta_pixel' ),
	'helpers define Meta Pixel for car-loan landing'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, '1108644925026801' ),
	'Meta Pixel ID is configured'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, "add_action( 'wp_head', 'ucredit_car_loan_meta_pixel'" ),
	'Meta Pixel hooks into wp_head'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_lead_im_payload' ),
	'helpers define Lead.im payload mapper'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, 'function ucredit_car_loan_lead_im_submit' ),
	'helpers define Lead.im submit handler'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, "add_action( 'wpcf7_mail_sent', 'ucredit_car_loan_lead_im_submit'" ),
	'helpers hook wpcf7_mail_sent for Lead.im'
);
car_loan_smoke_assert(
	false !== strpos( $helpers, '122910' ) && false !== strpos( $helpers, '1f2d4303e0' ),
	'Lead.im lm_form and lm_key defaults are configured'
);

$custom = (string) file_get_contents( $theme_root . '/inc/custom-functions.php' );
car_loan_smoke_assert(
	false === strpos( $custom, "add_filter('wpcf7_autop_or_not', '__return_false')" )
		&& false === strpos( $custom, 'add_filter( \'wpcf7_autop_or_not\', \'__return_false\' )' ),
	'wpcf7_autop_or_not is not unconditionally __return_false'
);
car_loan_smoke_assert(
	false !== strpos( $custom, "wpcf7_autop_or_not" )
		&& false !== strpos( $custom, "'mail'" ),
	'wpcf7_autop_or_not keeps mail autop enabled'
);

$docs = (string) file_get_contents( $theme_root . '/docs/car-loan-cf7-form.md' );
car_loan_smoke_assert(
	false !== strpos( $docs, 'Mail tab' ),
	'docs document CF7 Mail tab'
);
car_loan_smoke_assert(
	false !== strpos( $docs, '[_raw_has-car]' ),
	'docs recommend _raw_ mail tags for piped selects'
);
car_loan_smoke_assert(
	false !== strpos( $docs, 'Lead.im CRM' ) && false !== strpos( $docs, 'fld_286562' ),
	'docs document Lead.im CRM field mapping'
);

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', $theme_root . '/' );
}
if ( ! function_exists( 'add_filter' ) ) {
	/**
	 * @param mixed ...$args Unused.
	 */
	function add_filter( ...$args ): bool { // phpcs:ignore Universal.NamingConventions.NoReservedKeywordParameterNames
		return true;
	}
}
if ( ! function_exists( 'add_action' ) ) {
	/**
	 * @param mixed ...$args Unused.
	 */
	function add_action( ...$args ): bool {
		return true;
	}
}
if ( ! function_exists( '__' ) ) {
	/**
	 * @param string $text Text.
	 * @param string $domain Text domain.
	 */
	function __( string $text, string $domain = 'default' ): string {
		return $text;
	}
}
if ( ! function_exists( 'sanitize_text_field' ) ) {
	/**
	 * @param string $str Input.
	 */
	function sanitize_text_field( string $str ): string {
		return trim( strip_tags( $str ) );
	}
}
if ( ! function_exists( 'esc_html' ) ) {
	/**
	 * @param string $text Text.
	 */
	function esc_html( string $text ): string {
		return htmlspecialchars( $text, ENT_QUOTES, 'UTF-8' );
	}
}
if ( ! function_exists( 'esc_url_raw' ) ) {
	/**
	 * @param string $url URL.
	 */
	function esc_url_raw( string $url ): string {
		return $url;
	}
}

require_once $theme_root . '/inc/car-loan-helpers.php';

$mail_body = ucredit_car_loan_cf7_format_mail_body(
	array(
		'your-name'          => 'בדיקת טופס',
		'your-phone'         => '0522813333',
		'has-car'            => 'yes',
		'loan-amount'        => '250',
		'loan-term'          => '24',
		'acceptance-consent' => '1',
	)
);

car_loan_smoke_assert(
	false !== strpos( $mail_body, "\n" ),
	'mail body contains newlines'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, "שם: בדיקת טופס\n" ),
	'mail body maps name to שם'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, "טלפון: 0522813333\n" ),
	'mail body maps phone to טלפון'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, 'האם יש רכב בבעלותך?: כן' ),
	'mail body maps has-car yes to כן'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, 'סכום הלוואה: 100,000–250,000 ₪' ),
	'mail body maps amount 250 to Hebrew label'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, 'תקופת החזר: עד 24 חודשים' ),
	'mail body maps term 24 to Hebrew label'
);
car_loan_smoke_assert(
	false !== strpos( $mail_body, 'הסכמה: כן' ),
	'mail body maps consent to כן'
);
car_loan_smoke_assert(
	false === strpos( $mail_body, 'Consented' ),
	'mail body does not include CF7 Consented label'
);
car_loan_smoke_assert(
	false === strpos( $mail_body, 'Message Body:' ),
	'mail body does not include English Message Body wrapper'
);

$crm_payload = ucredit_car_loan_lead_im_payload(
	array(
		'your-name'          => 'בדיקת טופס',
		'your-phone'         => '0522813333',
		'has-car'            => 'yes',
		'loan-amount'        => '250',
		'loan-term'          => '24',
		'acceptance-consent' => '1',
	),
	'https://ucredit.co.il/car-loan/?utm_source=test'
);

car_loan_smoke_assert(
	(int) ( $crm_payload['lm_form'] ?? 0 ) === 122910,
	'CRM payload lm_form is 122910'
);
car_loan_smoke_assert(
	( $crm_payload['lm_key'] ?? '' ) === '1f2d4303e0',
	'CRM payload lm_key is configured'
);
car_loan_smoke_assert(
	( $crm_payload['lm_redirect'] ?? '' ) === 'no',
	'CRM payload lm_redirect is no'
);
car_loan_smoke_assert(
	( $crm_payload['name'] ?? '' ) === 'בדיקת טופס',
	'CRM payload maps name'
);
car_loan_smoke_assert(
	( $crm_payload['phone'] ?? '' ) === '0522813333',
	'CRM payload maps phone'
);
car_loan_smoke_assert(
	(int) ( $crm_payload['divur'] ?? -1 ) === 1,
	'CRM payload maps consent to divur=1'
);
car_loan_smoke_assert(
	( $crm_payload['modal_loan_term'] ?? '' ) === 'עד 24 חודשים',
	'CRM payload maps loan-term to modal_loan_term'
);
car_loan_smoke_assert(
	( $crm_payload['fld_286562'] ?? '' ) === '100,000–250,000 ₪',
	'CRM payload maps loan-amount to fld_286562'
);
car_loan_smoke_assert(
	( $crm_payload['fld_333225'] ?? '' ) === 'כן',
	'CRM payload maps has-car to fld_333225'
);
car_loan_smoke_assert(
	false !== strpos( (string) ( $crm_payload['lm_source'] ?? '' ), 'utm_source=test' ),
	'CRM payload includes lm_source with UTMs'
);

$scss = (string) file_get_contents( $theme_root . '/assets/scss/car-loan.scss' );
car_loan_smoke_assert(
	false !== strpos( $scss, 'car-loan-cf7-submit-wrap' ),
	'car-loan.scss styles CF7 submit wrap'
);

$lead = (string) file_get_contents( $theme_root . '/template-parts/car-loan/lead.php' );
car_loan_smoke_assert(
	false !== strpos( $lead, 'do_shortcode' ),
	'lead partial embeds CF7 via do_shortcode'
);
car_loan_smoke_assert(
	false !== strpos( $lead, 'contact-form-7' ),
	'lead partial validates CF7 shortcode pattern'
);

$script = (string) file_get_contents( $theme_root . '/assets/js/script.js' );
car_loan_smoke_assert(
	false !== strpos( $script, ".car-loan-lead__form" ),
	'script.js detects car-loan lead form on wpcf7mailsent'
);
car_loan_smoke_assert(
	false !== strpos( $script, "fbq('track', 'Lead'" ),
	'script.js fires Meta Pixel Lead on car-loan success'
);
car_loan_smoke_assert(
	false !== strpos( $script, 'תודה על פנייתכם נציגנו יחזרו אליכם בהקדם' ),
	'script.js shows Hebrew thank-you modal copy'
);
car_loan_smoke_assert(
	false !== strpos( $script, 'formId !== 167 && formId !== 775' ),
	'script.js still handles forms 167/775 after car-loan branch'
);

$compiled = $theme_root . '/style-rtl.css';
if ( is_file( $compiled ) ) {
	$css = (string) file_get_contents( $compiled );
	car_loan_smoke_assert(
		false !== strpos( $css, 'car-loan' ),
		'compiled style-rtl.css contains car-loan rules'
	);
} else {
	car_loan_smoke_assert( false, 'compiled style-rtl.css exists' );
}

if ( $failed > 0 ) {
	fwrite( STDERR, "\n{$failed} smoke assertion(s) failed.\n" );
	exit( 1 );
}

echo "\nAll Car Loan landing smoke checks passed.\n";
exit( 0 );
