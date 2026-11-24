<?php
/**
 * Car loan sticky header.
 *
 * @package ucredit
 */

$logo_id = function_exists( 'get_field' ) ? get_field( 'car_loan_logo' ) : null;
$cta     = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_header_cta' ) : '';
if ( $cta === '' ) {
	$cta = __( 'בדיקת זכאות חינם', 'ucredit' );
}
$phone   = ucredit_car_loan_phone_display();
$digits  = ucredit_car_loan_phone_digits();
?>
<header class="car-loan-header">
	<div class="car-loan-header__inner">
		<a href="#lead" class="car-loan-header__logo">
			<?php if ( $logo_id ) : ?>
				<?= wp_get_attachment_image( (int) $logo_id, 'medium', false, array( 'class' => 'car-loan-header__logo-img', 'alt' => 'UCredit' ) ); ?>
			<?php else : ?>
				<img src="<?= esc_url( assets( 'img/Ucredit_logo_Hebrew.png' ) ); ?>" alt="UCredit — <?= esc_attr__( 'הלוואה לכל מטרה', 'ucredit' ); ?>" class="car-loan-header__logo-img" width="160" height="46">
			<?php endif; ?>
		</a>
		<div class="car-loan-header__actions">
			<a href="tel:<?= esc_attr( $digits ); ?>" class="car-loan-header__phone" dir="ltr"><?= esc_html( $phone ); ?></a>
			<a href="#lead" class="car-loan-btn car-loan-btn--primary car-loan-header__cta"><?= esc_html( $cta ); ?></a>
		</div>
	</div>
</header>

