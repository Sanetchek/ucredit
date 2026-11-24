<?php
/**
 * Car loan fixed mobile CTA bar.
 *
 * @package ucredit
 */

$cta    = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_mobile_cta' ) : '';
$digits = ucredit_car_loan_phone_digits();

if ( $cta === '' ) {
	$cta = __( 'קבלו הצעה תוך דקות', 'ucredit' );
}
?>
<div class="car-loan-mobile-bar" data-m="mobilebar">
	<a href="#lead" class="car-loan-btn car-loan-btn--primary car-loan-mobile-bar__cta"><?= esc_html( $cta ); ?></a>
	<a href="tel:<?= esc_attr( $digits ); ?>" class="car-loan-mobile-bar__phone" aria-label="<?= esc_attr__( 'התקשרו אלינו', 'ucredit' ); ?>">☎</a>
</div>
