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
 */
// Remove auto wrap of "<p>"
add_filter('wpcf7_autop_or_not', '__return_false');

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