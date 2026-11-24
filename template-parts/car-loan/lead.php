<?php
/**
 * Car loan lead section with Contact Form 7.
 *
 * @package ucredit
 */

$title     = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_lead_title' ) : '';
$text      = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_lead_text' ) : '';
$checks    = function_exists( 'get_field' ) ? get_field( 'car_loan_lead_checks' ) : null;
$form_title = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_form_title' ) : '';
$form_sub  = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_form_subtitle' ) : '';
$shortcode = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_cf7_shortcode' ) : '';
$disclaimer = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_form_disclaimer' ) : '';

if ( $title === '' ) {
	$title = __( 'בדיקת זכאות חינם – בלי התחייבות', 'ucredit' );
}
if ( $text === '' ) {
	$text = __( 'השאירו פרטים ונציג יחזור אליכם עם הצעה אישית להלוואה כנגד שעבוד רכב – עד 250,000 ₪, אישור מיידי, הכסף תוך 3 ימי עסקים.', 'ucredit' );
}
if ( empty( $checks ) || ! is_array( $checks ) ) {
	$checks = ucredit_car_loan_default_lead_checks();
}
if ( $form_title === '' ) {
	$form_title = __( 'בקשת זכאות להלוואה', 'ucredit' );
}
if ( $form_sub === '' ) {
	$form_sub = __( 'מלאו את הפרטים – זה לוקח פחות מדקה.', 'ucredit' );
}
if ( $disclaimer === '' ) {
	$disclaimer = __( 'הפנייה אינה מהווה התחייבות לקבלת אשראי.', 'ucredit' );
}

$shortcode = trim( $shortcode );
?>
<section id="lead" class="car-loan-sec car-loan-lead">
	<div class="car-loan-lead__grid">
		<div class="car-loan-lead__content">
			<?php if ( $title ) : ?>
				<h2 class="car-loan-h2 car-loan-h2--light"><?= esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="car-loan-lead__text"><?= esc_html( $text ); ?></p>
			<?php endif; ?>

			<?php if ( $checks ) : ?>
				<ul class="car-loan-lead__checks">
					<?php foreach ( $checks as $item ) : ?>
						<?php
						$item_text = is_array( $item ) ? ( $item['text'] ?? '' ) : '';
						if ( $item_text === '' ) {
							continue;
						}
						?>
						<li class="car-loan-lead__check">
							<span class="car-loan-lead__check-icon" aria-hidden="true">✓</span>
							<?= esc_html( $item_text ); ?>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="car-loan-lead__card">
			<?php if ( $form_title ) : ?>
				<div class="car-loan-lead__form-title"><?= esc_html( $form_title ); ?></div>
			<?php endif; ?>
			<?php if ( $form_sub ) : ?>
				<div class="car-loan-lead__form-sub"><?= esc_html( $form_sub ); ?></div>
			<?php endif; ?>

			<div class="car-loan-lead__form">
				<?php if ( $shortcode !== '' && preg_match( '/^\[contact-form-7\b/i', $shortcode ) ) : ?>
					<?= do_shortcode( $shortcode ); ?>
				<?php elseif ( current_user_can( 'edit_pages' ) ) : ?>
					<p class="car-loan-lead__form-missing">
						<?= esc_html__( 'הגדירו את קוד הטופס (Contact Form 7) בשדה ACF של עמוד זה.', 'ucredit' ); ?>
					</p>
				<?php endif; ?>
			</div>

			<?php if ( $disclaimer ) : ?>
				<p class="car-loan-lead__disclaimer"><?= esc_html( $disclaimer ); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>
