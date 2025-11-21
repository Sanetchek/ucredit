<?php /* Template Name: Landing 1 */

get_header();
?>

	<main id="primary" class="site-main">

		<!-- Banking -->
		<?php get_template_part('template-parts/landing-1/banking') ?>

		<!-- Personalized Solution -->
		<?php get_template_part('template-parts/landing-1/persolution') ?>

		<!-- Plan your finance -->
		<?php get_template_part('template-parts/landing-1/plan') ?>

		<!-- How it works -->
		<?php get_template_part('template-parts/landing-1/how') ?>

		<!-- Loans -->
		<?php get_template_part('template-parts/landing-1/loan') ?>

		<!-- Business -->
		<?php get_template_part('template-parts/landing-1/business') ?>

		<!-- FAQ -->
		<?php get_template_part('template-parts/landing-1/faq') ?>

	</main><!-- #main -->

<?php
get_footer();
