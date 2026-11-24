<?php
/**
 * Car loan process section.
 *
 * @package ucredit
 */

$eyebrow = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_process_eyebrow' ) : '';
$title   = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_process_title' ) : '';
$text    = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_process_text' ) : '';
$cta     = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_process_cta' ) : '';
$steps   = function_exists( 'get_field' ) ? get_field( 'car_loan_process_steps' ) : null;
$image   = function_exists( 'get_field' ) ? get_field( 'car_loan_process_image' ) : null;

if ( $eyebrow === '' ) {
	$eyebrow = __( 'תנאים מיוחדים ובדיקת זכאות ללא עלות!', 'ucredit' );
}
if ( $title === '' ) {
	$title = __( 'איך זה עובד – 4 שלבים פשוטים', 'ucredit' );
}
if ( $text === '' ) {
	$text = __( 'כל התהליך דיגיטלי, מלווה בנציג אישי, וללא התחייבות עד שתאשרו את התנאים.', 'ucredit' );
}
if ( $cta === '' ) {
	$cta = __( 'לבדיקת זכאות מהירה', 'ucredit' );
}
if ( empty( $steps ) || ! is_array( $steps ) ) {
	$steps = ucredit_car_loan_default_steps();
}
?>
<section class="car-loan-sec car-loan-process">
	<div class="car-loan-process__grid">
		<div class="car-loan-process__content">
			<?php if ( $eyebrow ) : ?>
				<p class="car-loan-eyebrow"><?= esc_html( $eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<h2 class="car-loan-h2"><?= esc_html( $title ); ?></h2>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="car-loan-process__text"><?= esc_html( $text ); ?></p>
			<?php endif; ?>

			<ol class="car-loan-process__steps">
				<?php foreach ( $steps as $i => $step ) : ?>
					<?php
					$step_title = is_array( $step ) ? ( $step['title'] ?? '' ) : '';
					$step_text  = is_array( $step ) ? ( $step['text'] ?? '' ) : '';
					if ( $step_title === '' ) {
						continue;
					}
					?>
					<li class="car-loan-process__step">
						<span class="car-loan-process__num" aria-hidden="true"><?= (int) $i + 1; ?></span>
						<div>
							<div class="car-loan-process__step-title"><?= esc_html( $step_title ); ?></div>
							<?php if ( $step_text ) : ?>
								<div class="car-loan-process__step-text"><?= esc_html( $step_text ); ?></div>
							<?php endif; ?>
						</div>
					</li>
				<?php endforeach; ?>
			</ol>

			<a href="#lead" class="car-loan-btn car-loan-btn--primary car-loan-btn--lg"><?= esc_html( $cta ); ?></a>
		</div>

		<div class="car-loan-process__media">
			<?php if ( $image ) : ?>
				<?= wp_get_attachment_image( (int) $image, 'large', false, array( 'class' => 'car-loan-process__img', 'alt' => esc_attr__( 'תהליך קבלת ההלוואה', 'ucredit' ) ) ); ?>
			<?php else : ?>
				<img
					src="https://ucredit.co.il/wp-content/uploads/2025/08/Ucredit_Shiabud_car2-1024x464.jpg"
					alt="<?= esc_attr__( 'תהליך קבלת ההלוואה', 'ucredit' ); ?>"
					class="car-loan-process__img"
					width="1024"
					height="464"
					loading="lazy"
					decoding="async"
				>
			<?php endif; ?>
		</div>
	</div>
</section>
