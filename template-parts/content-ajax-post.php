<?php
/**
 * Template part for displaying posts loaded via AJAX
 *
 * @package ucredit
 */

// Get post data from the passed post object
$post_id = $post->ID ?? get_the_ID();
$post_title = $post->post_title ?? get_the_title();
$post_excerpt = $post->post_excerpt ?? get_the_excerpt();
$post_permalink = $post->permalink ?? get_permalink();
$post_date = $post->date ?? get_the_date('d/m/Y');
$post_date_iso = $post->date_iso ?? get_the_date('Y-m-d');
$post_categories = $post->categories ?? wp_get_post_categories($post_id, array('fields' => 'names'));
$post_featured_image = $post->featured_image ?? get_the_post_thumbnail_url($post_id, 'medium_large');

// Ensure we have valid data
$post_title = !empty($post_title) ? $post_title : __('אין כותרת', 'ucredit');
$post_excerpt = !empty($post_excerpt) ? $post_excerpt : __('אין תקציר', 'ucredit');
$post_permalink = !empty($post_permalink) ? $post_permalink : '#';
$post_date = !empty($post_date) ? $post_date : __('אין תאריך', 'ucredit');
$post_date_iso = !empty($post_date_iso) ? $post_date_iso : '';
$post_categories = is_array($post_categories) ? $post_categories : array();

// Fallback image
$fallback_image = get_template_directory_uri() . '/assets/img/image_holder.jpg';
?>

<article class="archive-post-card" data-post-id="<?php echo esc_attr($post_id); ?>">
	<div class="post-card-inner">
		<!-- Featured Image -->
		<div class="post-card-image">
			<a href="<?php echo esc_url($post_permalink); ?>" class="post-image-link">
				<?php if ($post_featured_image) : ?>
					<img src="<?php echo esc_url($post_featured_image); ?>" class="post-thumbnail" alt="<?php echo esc_attr($post_title); ?>">
				<?php else : ?>
					<img src="<?php echo esc_url($fallback_image); ?>" class="post-thumbnail" alt="<?php echo esc_attr($post_title); ?>">
				<?php endif; ?>
				<div class="post-image-overlay">
					<span class="read-more"><?= __('קרא עוד', 'ucredit') ?></span>
				</div>
			</a>
		</div>

		<!-- Post Content -->
		<div class="post-card-content">
			<!-- Post Meta -->
			<div class="post-meta">
				<span class="post-date" data-date="<?php echo esc_attr($post_date_iso); ?>">
					<?php echo esc_html($post_date); ?>
				</span>
				<?php if (!empty($post_categories)) : ?>
					<span class="post-categories">
						<?php echo esc_html(implode(', ', $post_categories)); ?>
					</span>
				<?php endif; ?>
			</div>

			<!-- Post Title -->
			<h2 class="post-title">
				<a href="<?php echo esc_url($post_permalink); ?>"><?php echo esc_html($post_title); ?></a>
			</h2>

			<!-- Post Excerpt -->
			<div class="post-excerpt">
				<?php if (!empty($post_excerpt)) : ?>
					<p><?php echo esc_html($post_excerpt); ?></p>
				<?php endif; ?>
			</div>

			<!-- Post Footer -->
			<div class="post-card-footer">
				<a href="<?php echo esc_url($post_permalink); ?>" class="read-more-btn">
					<?= __('קרא עוד', 'ucredit') ?>
					<svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
			</div>
		</div>
	</div>
</article>