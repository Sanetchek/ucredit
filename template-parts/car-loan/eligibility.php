<?php
/**
 * Car loan eligibility cards.
 *
 * @package ucredit
 */

$title = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_elig_title' ) : '';
$text  = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_elig_text' ) : '';
$cards = function_exists( 'get_field' ) ? get_field( 'car_loan_elig_cards' ) : null;

if ( $title === '' ) {
	$title = __( 'מי יכול לקבל?', 'ucredit' );
}
if ( $text === '' ) {
	$text = __( 'התנאים הבסיסיים לשעבוד רכב ב-UCredit. גם אם קיבלתם סירוב מהבנק – שווה לבדוק.', 'ucredit' );
}
if ( empty( $cards ) || ! is_array( $cards ) ) {
	$cards = ucredit_car_loan_default_elig_cards();
}
?>
<section class="car-loan-sec car-loan-elig">
	<div class="car-loan-elig__inner">
		<?php if ( $title ) : ?>
			<h2 class="car-loan-h2 car-loan-h2--center"><?= esc_html( $title ); ?></h2>
		<?php endif; ?>

		<?php if ( $text ) : ?>
			<p class="car-loan-elig__intro"><?= esc_html( $text ); ?></p>
		<?php endif; ?>

		<div class="car-loan-elig__cards">
			<?php foreach ( $cards as $card ) : ?>
				<?php
				$card_title = is_array( $card ) ? ( $card['title'] ?? '' ) : '';
				$card_text  = is_array( $card ) ? ( $card['text'] ?? '' ) : '';
				if ( $card_title === '' ) {
					continue;
				}
				?>
				<div class="car-loan-elig__card">
					<div class="car-loan-elig__card-title"><?= esc_html( $card_title ); ?></div>
					<?php if ( $card_text ) : ?>
						<div class="car-loan-elig__card-text"><?= esc_html( $card_text ); ?></div>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
