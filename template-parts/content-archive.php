<?php
/**
 * Template part for displaying posts in archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ucredit
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'archive-post-card' ); ?> data-post-id="<?php the_ID(); ?>" data-categories="<?php echo esc_attr(implode(',', wp_get_post_categories(get_the_ID(), array('fields' => 'names')))); ?>">
	<div class="post-card-inner">
		<!-- Featured Image -->
		<div class="post-card-image">
			<a href="<?php the_permalink(); ?>" class="post-image-link">
				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-thumbnail' ) ); ?>
				<?php else : ?>
					<img src="<?= get_template_directory_uri() ?>/assets/img/image_holder.jpg" class="post-thumbnail" alt="shows">
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
				<span class="post-date" data-date="<?php echo get_the_date('Y-m-d'); ?>">
					<?php echo get_the_date( 'd/m/Y' ); ?>
				</span>
				<?php if ( has_category() ) : ?>
					<span class="post-categories">
						<?php the_category( ', ' ); ?>
					</span>
				<?php endif; ?>
			</div>

			<!-- Post Title -->
			<h2 class="post-title">
				<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			</h2>

			<!-- Post Excerpt -->
			<div class="post-excerpt">
				<?php
				if ( has_excerpt() ) {
					the_excerpt();
				} else {
					$content = get_the_content();
					$excerpt = wp_trim_words( $content, 25, '...' );
					echo '<p>' . $excerpt . '</p>';
				}
				?>
			</div>

			<!-- Post Footer -->
			<div class="post-card-footer">
				<a href="<?php the_permalink(); ?>" class="read-more-btn">
					<?= __('קרא עוד', 'ucredit') ?>
					<svg class="arrow-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M7 17L17 7M17 7H7M17 7V17" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
					</svg>
				</a>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->