<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ucredit
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'article' ); ?>>
	<div class="container">
		<div class="row row__60_30">
			<!-- Main Content -->
			<div class="col-60 article-main-content">
				<div class="article-header">
					<!-- Breadcrumbs -->
					<?php ucredit_breadcrumbs(); ?>

					<!-- Article Title and Date -->
					<div class="article-title-section">
						<h1 class="article-title"><?php the_title(); ?></h1>
						<div class="article-meta">
							<span class="article-date"><?php echo get_the_date('F Y'); ?></span>
							<?php if (has_category()) : ?>
								<span class="article-category">
									<span class="meta-label"><?= __('קטגוריה', 'ucredit') ?>:</span>
									<?php the_category(', '); ?>
								</span>
							<?php endif; ?>
							<?php if (has_tag()) : ?>
								<span class="article-tags">
									<span class="meta-label"><?= __('תגיות', 'ucredit') ?>:</span>
									<?php the_tags('', ', '); ?>
								</span>
							<?php endif; ?>
						</div>
					</div>

					<!-- Featured Image -->
					<?php if (has_post_thumbnail()) : ?>
						<div class="article-featured-image">
							<?php the_post_thumbnail('large', array('class' => 'featured-img')); ?>
						</div>
					<?php endif; ?>
				</div>

				<!-- Article Content -->
				<main class="article-main">
					<div class="article-content">
						<?php the_content(); ?>
					</div>

					<!-- FAQ Section -->
					<?php if (get_field('faq_questions')) : ?>
						<section class="article-faq">
							<div class="faq-section faq__content anim-items">
								<h3 class="faq-title"><?= __('שאלות נפוצות', 'ucredit') ?></h3>
								<div class="faq__tabs">
									<?php
									$faq = get_field('faq_questions');
									foreach ($faq as $item) : ?>
										<div class="faq__tab">
											<div class="faq__open">
												<div class="faq__open_dash"></div>
												<div class="faq__open_dash"></div>
											</div>
											<h5 class="faq__tab_question"><?php echo $item['question']; ?></h5>
											<p class="faq__tab_answer"><?php echo $item['answer']; ?></p>
										</div>
									<?php endforeach; ?>
								</div>
							</div>
						</section>
					<?php endif; ?>

					<!-- Social Share -->
					<?php if (function_exists('socialShare')) : ?>
						<?php echo socialShare(get_the_permalink(), get_the_title()); ?>
					<?php endif; ?>
				</main>
			</div>

			<!-- Sidebar -->
			<div class="col-30 article-sidebar">
				<div class="sidebar-widget recommended-posts">
					<h4 class="widget-title">
						<img src="<?= get_template_directory_uri() ?>/assets/img/article-icon.webp" alt="posts">
						<?= __('מאמרים נוספים', 'ucredit') ?>
					</h4>
					<div class="recommended-posts-list">
						<?php
						$recommended_posts = new WP_Query(array(
							'post_type' => 'post',
							'posts_per_page' => 7,
							'post__not_in' => array(get_the_ID()),
							'orderby' => 'date',
							'order' => 'DESC'
						));

						if ($recommended_posts->have_posts()) :
							while ($recommended_posts->have_posts()) : $recommended_posts->the_post();
						?>
							<article class="recommended-post">
								<?php if (has_post_thumbnail()) : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail('thumbnail', array('class' => 'post-img')); ?>
										</a>
									</div>
								<?php else : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<img src="<?= get_template_directory_uri() ?>/assets/img/image_holder.jpg" alt="shows">
										</a>
									</div>
								<?php endif; ?>
								<div class="post-content">
									<h5 class="post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h5>
									<span class="post-date"><?php echo get_the_date('d/m/Y'); ?></span>
								</div>
							</article>
						<?php
							endwhile;
							wp_reset_postdata();
						endif;
						?>
					</div>
				</div>

				<div class="sidebar-widget bank-logos">
					<h4 class="widget-title">
						<img src="<?= get_template_directory_uri() ?>/assets/img/bank-icon.webp" alt="Bank Icon">
						<?php if (get_field('bank_logo_title', 'option')) : ?>
							<?= get_field('bank_logo_title', 'option') ?>
						<?php else : ?>
							<?= __('הלוואה ניתנת ללקוחות כל הבנקים', 'ucredit') ?>
						<?php endif; ?>
					</h4>
					<?php get_template_part('template-parts/bank-logos') ?>
				</div>

				<div class="sidebar-widget loan-amount">
					<?= do_shortcode('[loan_calculator]') ?>
				</div>
			</div>
		</div>
	</div>
</article><!-- #post-<?php the_ID(); ?> -->