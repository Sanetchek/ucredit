<?php
/**
 * Ucredit Banner Gutenberg Block (theme-integrated)
 */
if (!defined('ABSPATH')) {
    exit;
}

add_action('init', function () {
    $dir = get_stylesheet_directory() . '/inc/blocks/ucredit-banner';
    register_block_type(
        $dir,
        ['render_callback' => 'ucredit_banner_render']
    );
});

/**
 * Dynamic front-end render.
 *
 * @param array $attributes
 * @return string
 */
function ucredit_banner_render($attributes = [])
{
    $imageId = isset($attributes['imageId']) ? intval($attributes['imageId']) : 0;
    $imageUrl = isset($attributes['imageUrl']) ? esc_url($attributes['imageUrl']) : '';
    $imageAlt = isset($attributes['imageAlt']) ? esc_attr($attributes['imageAlt']) : 'banner';

    $title = isset($attributes['title']) ? wp_kses_post($attributes['title']) : '';
    $description = isset($attributes['description']) ? wp_kses_post($attributes['description']) : '';

    $linkUrl = isset($attributes['linkUrl']) ? esc_url($attributes['linkUrl']) : '';
    $linkLabel = isset($attributes['linkLabel']) ? wp_kses_post($attributes['linkLabel']) : '';

    $showModal = !empty($attributes['showModal']);
    $modalId = !empty($attributes['modalId']) ? sanitize_title($attributes['modalId']) : 'modal';

    // Prefer formId+title if available; fallback to raw shortcode.
    $cf7FormId = !empty($attributes['cf7FormId']) ? intval($attributes['cf7FormId']) : 0;
    $cf7FormTitle = !empty($attributes['cf7FormTitle']) ? sanitize_text_field($attributes['cf7FormTitle']) : '';
    if ($cf7FormId) {
        $cf7Shortcode = sprintf('[contact-form-7 id="%d"%s]', $cf7FormId, $cf7FormTitle ? ' title="' . esc_attr($cf7FormTitle) . '"' : '');
    } else {
        $cf7Shortcode = !empty($attributes['cf7Shortcode']) ? $attributes['cf7Shortcode'] : '[contact-form-7 id="167" title="Contact form"]';
    }

    // Image
    if ($imageId) {
        $imageHtml = wp_get_attachment_image($imageId, 'medium', false, [
            'class' => 'footer__banner_img',
            'alt' => $imageAlt
        ]);
    } elseif ($imageUrl) {
        $imageHtml = sprintf('<img src="%s" alt="%s" class="footer__banner_img">', $imageUrl, $imageAlt);
    } else {
        $fallback = get_theme_file_uri('assets/img/footer_baner.svg');
        $imageHtml = sprintf('<img src="%s" alt="banner" class="footer__banner_img">', esc_url($fallback));
    }

    $btnClasses = 'btn btn__bluelight btn__shadow' . ($showModal ? ' modal-show' : '');
    $btnHref = $linkUrl ?: '#';

    ob_start(); ?>
    <div class="footer__banner banner-article">
        <?php echo $imageHtml; ?><!-- banner image -->

        <div class="footer__banner_wrap">
            <?php if ($title): ?>
                <h3><?php echo $title; ?></h3>
            <?php endif; ?><!-- banner title -->

            <?php if ($description): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?><!-- banner description -->

            <?php if ($linkUrl || $linkLabel): ?>
                <a href="<?php echo $btnHref; ?>" class="<?php echo esc_attr($btnClasses); ?>" <?php echo $showModal ? 'data-modal="' . esc_attr($modalId) . '"' : ''; ?>>
                    <?php echo $linkLabel ? $linkLabel : esc_html__('Button', 'ucredit'); ?>
                </a>
            <?php endif; ?><!-- banner link -->
        </div>
    </div>

    <?php if ($showModal): ?>
        <?php echo ucredit_banner_modal_html($modalId, $cf7Shortcode); ?>
    <?php endif;

    return ob_get_clean();
}

/**
 * Modal HTML
 *
 * @param string $modal_id
 * @param string $cf7_shortcode
 * @return string
 */
function ucredit_banner_modal_html($modal_id = 'modal', $cf7_shortcode = '[contact-form-7 id="167" title="Contact form"]')
{
    ob_start(); ?>
    <div id="<?php echo esc_attr($modal_id); ?>" class="modal-wrap">
        <div class="bg-overlay blue"></div>

        <section class="modal">
            <button type="button" class="close modal-close">
                <span></span>
                <span></span>
            </button>
            <?php echo do_shortcode($cf7_shortcode); ?>
        </section>
    </div>
    <?php
    return ob_get_clean();
}
