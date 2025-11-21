<div class="bank-logos-list">
    <?php
    $bank_logos = get_field('bank_logo_list', 'option');
    foreach ($bank_logos as $logo): ?>
        <div class="bank-logo">
            <?php
            $image_id = $logo['bank_logo'];
            $image_url = wp_get_attachment_image_src($image_id, 'full')[0];
            $image_alt = get_the_title($image_id);
            ?>
            <img src="<?= esc_url($image_url) ?>" alt="<?= esc_attr($image_alt) ?>">
        </div>
    <?php endforeach; ?>
</div>