<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ucredit
 */

get_header();
?>

	<main id="primary" class="site-main">

		<div class="container">
			<section class="error-404 not-found">

				<header class="page-header">
					<?php $title = get_field('404_title', 'option'); ?>

					<?php if ($title) : ?>
						<h1 class="page-title"><?= $title ?></h1>
					<?php endif; ?>
				</header><!-- .page-header -->

				<div class="page-content">
					<?php $link = get_field('404_link', 'option'); ?>

					<?php if ($link) : ?>
						<a href="<?= $link['url'] ?>"><?= $link['title'] ?></a>
					<?php endif; ?>
				</div><!-- .page-content -->

			</section><!-- .error-404 -->
		</div><!-- .container -->

	</main><!-- #main -->

<?php
get_footer();
