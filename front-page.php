<?php
/**
 * The front-page template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ucredit
 */

get_header();
?>

	<main id="primary" class="site-main">

		<!-- Banking -->
		<?php get_template_part('template-parts/front/banking') ?>

		<!-- About Us -->
		<?php get_template_part('template-parts/front/about') ?>

		<!-- Loan Calculator -->
		<?php get_template_part('template-parts/front/loan-calculator') ?>

		<!-- Personalized Solution -->
		<?php get_template_part('template-parts/front/persolution') ?>

		<!-- Plan your finance -->
		<?php get_template_part('template-parts/front/plan') ?>

		<!-- How it works -->
		<?php get_template_part('template-parts/front/how') ?>

		<!-- Loans -->
		<?php get_template_part('template-parts/front/loan') ?>

		<!-- Business -->
		<?php get_template_part('template-parts/front/business') ?>

		<!-- FAQ -->
		<?php get_template_part('template-parts/front/faq') ?>

	</main><!-- #main -->

<?php
get_footer();
