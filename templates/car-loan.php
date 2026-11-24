<?php
/**
 * Template Name: Car Loan
 *
 * Car lien loan landing page (הלוואה כנגד שעבוד רכב).
 *
 * @package ucredit
 */

get_header();
?>

	<main id="primary" class="site-main car-loan">

		<?php get_template_part( 'template-parts/car-loan/header' ); ?>
		<?php get_template_part( 'template-parts/car-loan/hero' ); ?>
		<?php get_template_part( 'template-parts/car-loan/stats' ); ?>
		<?php get_template_part( 'template-parts/car-loan/process' ); ?>
		<?php get_template_part( 'template-parts/car-loan/eligibility' ); ?>
		<?php get_template_part( 'template-parts/car-loan/banks' ); ?>
		<?php get_template_part( 'template-parts/car-loan/lead' ); ?>
		<?php get_template_part( 'template-parts/car-loan/faq' ); ?>
		<?php get_template_part( 'template-parts/car-loan/footer' ); ?>
		<?php get_template_part( 'template-parts/car-loan/mobile-bar' ); ?>

	</main><!-- #main -->

<?php
get_footer();
