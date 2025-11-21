<?php
/**
 * Template Name: Posts Filter
 * 
 * A custom page template for displaying all posts with filtering capabilities
 *
 * @package ucredit
 */

get_header();
?>

<main id="primary" class="site-main">
	<!-- Hero Section -->
	<div class="archive-hero">
		<div class="container">
			<div class="archive-hero-content">
				<!-- Breadcrumbs -->
				<?php ucredit_breadcrumbs(); ?>
				
				<!-- Page Header -->
				<header class="archive-header">
					<h1 class="archive-title"><?php the_title(); ?></h1>
					<?php if (get_field('page_description')) : ?>
						<div class="archive-description"><?php echo get_field('page_description'); ?></div>
					<?php endif; ?>
				</header>
			</div>
		</div>
	</div>

	<!-- Posts Filter Content -->
	<div class="archive-content">
		<?php get_template_part('template-parts/content', 'posts-filter'); ?>
	</div>
</main>

<?php
get_footer(); 