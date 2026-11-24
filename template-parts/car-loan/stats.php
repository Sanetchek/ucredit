<?php
/**
 * Car loan stats strip.
 *
 * @package ucredit
 */

$stats = function_exists( 'get_field' ) ? get_field( 'car_loan_stats' ) : null;
if ( empty( $stats ) || ! is_array( $stats ) ) {
	$stats = ucredit_car_loan_default_stats();
}
?>
<section class="car-loan-sec car-loan-stats" aria-label="<?= esc_attr__( 'נתונים', 'ucredit' ); ?>">
	<div class="car-loan-stats__grid">
		<?php foreach ( $stats as $stat ) : ?>
			<?php
			$value = is_array( $stat ) ? ( $stat['value'] ?? '' ) : '';
			$label = is_array( $stat ) ? ( $stat['label'] ?? '' ) : '';
			if ( $value === '' && $label === '' ) {
				continue;
			}
			?>
			<div class="car-loan-stats__item">
				<div class="car-loan-stats__value"><?= esc_html( $value ); ?></div>
				<div class="car-loan-stats__label"><?= esc_html( $label ); ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
