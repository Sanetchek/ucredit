<?php

/**
 * Break content on N words
 *
 * @param [type] $text
 * @param integer $counttext
 * @param string $sep
 * @return void
 */
function ucredit_str_word($text, $counttext = 30, $sep = ' ') {
	$words = explode($sep, $text);

	if ( count($words) > $counttext )
		$text = join($sep, array_slice($words, 0, $counttext));

	return $text;
}

/**
 * Login redirect if not administrator
 */
add_action('admin_init', function () {
	if (is_admin() && !(current_user_can('administrator')) && (!defined('DOING_AJAX') || !DOING_AJAX)) {
		wp_redirect(home_url(404), 302);
		exit();
	}
});

/**
 * Contact form 7 remove span
 */
add_filter('wpcf7_form_elements', function($content) {
	$content = preg_replace('/<(span).*?class="\s*(?:.*\s)?wpcf7-form-control-wrap(?:\s[^"]+)?\s*"[^\>]*>(.*)<\/\1>/i', '\2', $content);

	$content = str_replace('<br />', '', $content);

	return $content;
});

/**
 * Get Current Url
 */
function currUrl()
{
	global $wp;
	return home_url($wp->request);
}

/**
 * get assets
 */
function assets($source = '')
{
	return get_template_directory_uri() . '/assets/' . $source;
}

/**
 * get image
 */
function get_image($img = '', $thumb = 'large', $attr = [])
{
	return wp_get_attachment_image($img, $thumb, '', $attr);
}

/**
 * Social Share
 *
 * @param [string] $url
 * @param [string] $title
 * @return string
 */
function socialShare($url, $title) {
	// Properly encode URL and title for safe use in URLs
	$encoded_url = urlencode($url);
	$encoded_title = urlencode($title);

	return '<div class="social_share">
		<div class="article-social">
			<a class="social_share_link social_share_whatsapp"
				href="https://api.whatsapp.com/send?text=' . $encoded_title . '%20' . $encoded_url . '"
				title="WhatsApp" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg">
					<img src="' . get_template_directory_uri() . '/assets/img/icons/s-whatsapp.svg" alt="WhatsApp" />
				</span>
			</a>
			<a class="social_share_link social_share_facebook"
				href="https://www.facebook.com/sharer/sharer.php?u=' . $encoded_url . '"
				title="Facebook" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg">
					<img src="' . get_template_directory_uri() . '/assets/img/icons/s-facebook.svg" alt="Facebook" />
				</span>
			</a>
			<a class="social_share_link social_share_email"
				href="mailto:?subject=' . $encoded_title . '&body=' . $encoded_title . '%20' . $encoded_url . '"
				title="Email" rel="nofollow noopener">
				<span class="social_share_svg">
					<img src="' . get_template_directory_uri() . '/assets/img/icons/s-mail.svg" alt="Email" />
				</span>
			</a>
			<a class="social_share_link social_share_twitter"
				href="https://twitter.com/intent/tweet?text=' . $encoded_title . '&url=' . $encoded_url . '"
				title="Twitter" rel="nofollow noopener" target="_blank">
				<span class="social_share_svg">
					<img src="' . get_template_directory_uri() . '/assets/img/icons/s-twitter.svg" alt="Twitter" />
				</span>
			</a>
		</div>
	</div>';
}

/**
 * Show YouTube Video
 */
function showYoutubeVideo( $link ) {
	$video = $link;
	$video = substr($video, strpos($video, "=") + 1);
	if($link) :	?>
		<iframe width="635" height="405" src="https://www.youtube.com/embed/<?= $video ?>" title="YouTube video player" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
	<?php else: ?>
		<img src="https://img.youtube.com/vi/<?php $video ?>/default.jpg" class="br-40" alt="youtube">
	<?php endif;
}

/**
 * Contact Form 7
 *
 * Keep form markup free of auto-<p> wrappers, but allow autop for HTML mail
 * so newlines become <br>/<p> and Gmail does not collapse the body to one line.
 */
add_filter(
	'wpcf7_autop_or_not',
	static function ( $autop, $options = array() ) {
		$options = wp_parse_args( $options, array( 'for' => 'form' ) );
		if ( 'mail' === $options['for'] ) {
			return true;
		}
		return false;
	},
	10,
	2
);

/**
 * Summary of show_modal
 * @param mixed $modal_id
 * @param mixed $cf7_shortcode
 * @return void
 */
function show_modal($modal_id, $cf7_shortcode = '') {
	$modal_id = $modal_id ?: 'modal';
	$cf7_shortcode = $cf7_shortcode ?: '[contact-form-7 id="167" title="Contact form"]';
	?>
	<div id="<?= $modal_id ?>" class="modal-wrap">
		<div class="bg-overlay blue"></div>

		<section class="modal">
			<button type="button" class="close modal-close">
				<span></span>
				<span></span>
			</button>
			<?= do_shortcode($cf7_shortcode); ?>
		</section>
	</div>
	<?php
}

/**
 * Show Modal by default
 */
add_action('wp_footer', function() {
	show_modal('modal', '[contact-form-7 id="167" title="Contact form"]'); // default modal
});

/**
 * Wizard popup strings for JS (from ACF Options).
 * Fallbacks when ACF repeater is empty.
 *
 * @return array<string, mixed>
 */
function ucredit_get_wizard_strings() {
	$step1_defaults = array(
		array( 'value' => 'minus', 'label' => 'סגירת מינוס / הוצאות שוטפות' ),
		array( 'value' => 'business', 'label' => 'הקמת או חיזוק עסק' ),
		array( 'value' => 'vehicle', 'label' => 'רכב / ציוד / כלי עבודה' ),
		array( 'value' => 'event', 'label' => 'אירוע, לימודים או חופשה' ),
		array( 'value' => 'investment', 'label' => 'השקעה או שדרוג נכס' ),
		array( 'value' => 'other', 'label' => 'משהו אחר' ),
	);
	$step2_defaults = array(
		array( 'value' => 'up20', 'label' => 'עד 20 אלף ש"ח' ),
		array( 'value' => 'up50', 'label' => 'עד 50 אלף ש"ח' ),
		array( 'value' => 'between50-100', 'label' => 'בין 50 ל-100 אלף ש"ח' ),
		array( 'value' => 'up250', 'label' => 'עד 250 אלף ש"ח' ),
		array( 'value' => 'unsure', 'label' => 'עדיין לא בטוח / רוצה ייעוץ' ),
	);

	$step1_options = get_field( 'wizard_step1_options', 'option' );
	$step2_options = get_field( 'wizard_step2_options', 'option' );

	return array(
		'step1_title'    => get_field( 'wizard_step1_title', 'option' ) ?: 'עבור מה אתם צריכים הלוואה?',
		'step1_subtitle' => get_field( 'wizard_step1_subtitle', 'option' ) ?: 'עוזר לנו להתאים את ההצעה – לא מחייב',
		'step1_options'  => is_array( $step1_options ) && ! empty( $step1_options ) ? $step1_options : $step1_defaults,
		'step2_title'    => get_field( 'wizard_step2_title', 'option' ) ?: 'איזה סדר גודל של סכום רלוונטי לכם?',
		'step2_subtitle' => get_field( 'wizard_step2_subtitle', 'option' ) ?: 'אפשר לשנות את הסכום בהמשך',
		'step2_options'  => is_array( $step2_options ) && ! empty( $step2_options ) ? $step2_options : $step2_defaults,
		'step3_title'    => get_field( 'wizard_step3_title', 'option' ) ?: 'מצאנו כיוון שמתאים לכם',
		'step3_subtitle' => get_field( 'wizard_step3_subtitle', 'option' ) ?: 'השאירו פרטים ונחזור אליכם עם הצעה מותאמת',
		'placeholder_name'  => get_field( 'wizard_placeholder_name', 'option' ) ?: 'שם מלא',
		'placeholder_phone' => get_field( 'wizard_placeholder_phone', 'option' ) ?: 'טלפון ליצירת קשר (ללא התחייבות)',
		'trust_1' => get_field( 'wizard_trust_1', 'option' ) ?: 'פרטים נשמרים בדיסקרטיות מלאה',
		'trust_2' => get_field( 'wizard_trust_2', 'option' ) ?: 'חזרה מהירה',
		'trust_3' => get_field( 'wizard_trust_3', 'option' ) ?: 'ללא התחייבות',
		'consent_text' => get_field( 'wizard_consent_text', 'option' ) ?: 'אני מאשר/ת יצירת קשר בהתאם לתנאי השימוש ומדיניות הפרטיות',
	);
}