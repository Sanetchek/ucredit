<?php
/**
 * Car loan banks section.
 *
 * @package ucredit
 */

$show = function_exists( 'get_field' ) ? get_field( 'car_loan_show_banks' ) : true;
if ( $show === false || $show === 0 || $show === '0' ) {
	return;
}

$eyebrow = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_banks_eyebrow' ) : '';
$title   = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_banks_title' ) : '';

if ( $eyebrow === '' ) {
	$eyebrow = __( 'עובדים עם כל גופי המימון הגדולים', 'ucredit' );
}
if ( $title === '' ) {
	$title = __( 'ההלוואה ניתנת ללקוחות כל הבנקים', 'ucredit' );
}

$bank_logos = function_exists( 'get_field' ) ? get_field( 'bank_logo_list', 'option' ) : null;
if ( empty( $bank_logos ) || ! is_array( $bank_logos ) ) {
	return;
}
?>
<section class="car-loan-sec car-loan-banks">
	<div class="car-loan-banks__inner">
		<?php if ( $eyebrow ) : ?>
			<p class="car-loan-eyebrow car-loan-eyebrow--center"><?= esc_html( $eyebrow ); ?></p>
		<?php endif; ?>

		<?php if ( $title ) : ?>
			<h2 class="car-loan-h2 car-loan-h2--center"><?= esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php get_template_part( 'template-parts/bank-logos' ); ?>
	</div>
</section>
