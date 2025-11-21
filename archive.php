<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ucredit
 */

get_header();
?>

	<main id="primary" class="site-main">
		<div class="archive-hero">
			<div class="container">
				<div class="archive-hero-content">
					<!-- Breadcrumbs -->
					<?php ucredit_breadcrumbs(); ?>

					<!-- Archive Header -->
					<header class="archive-header">
						<?php
						the_archive_title( '<h1 class="archive-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
						?>
					</header><!-- .archive-header -->
				</div>
			</div>
		</div>

		<div class="archive-content">
			<div class="container">
				<?php if ( have_posts() ) : ?>

					<!-- Posts Grid -->
					<div class="posts-grid">
						<?php
						/* Start the Loop */
						while ( have_posts() ) :
							the_post();
							/*
							* Include the Post-Type-specific template for the content.
							* If you want to override this in a child theme, then include a file
							* called content-___.php (where ___ is the Post Type name) and that will be used instead.
							*/
							get_template_part( 'template-parts/content', 'archive' );

						endwhile; ?>
					</div>

					<!-- Pagination -->
					<div class="archive-pagination">
						<?php
						the_posts_pagination(array(
							'mid_size'  => 2,
							'prev_text' => __( 'הקודם', 'ucredit' ),
							'next_text' => __( 'הבא', 'ucredit' ),
						));
						?>
					</div>

				<?php else : ?>
					<!-- No Posts Found -->
					<div class="no-posts-found">
						<?php get_template_part( 'template-parts/content', 'none' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</main><!-- #main -->

<?php
get_footer();
