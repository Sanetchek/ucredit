<?php
/**
 * Car loan FAQ — matches Hebrew landing design (+/− accordion).
 *
 * @package ucredit
 */

$title = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_faq_title' ) : '';
$items = function_exists( 'get_field' ) ? get_field( 'car_loan_faq_items' ) : null;

if ( $title === '' ) {
	$title = __( 'שאלות נפוצות', 'ucredit' );
}
if ( empty( $items ) || ! is_array( $items ) ) {
	$items = ucredit_car_loan_default_faq();
}
?>
<section class="car-loan-sec car-loan-faq">
	<div class="car-loan-faq__inner">
		<?php if ( $title ) : ?>
			<h2 class="car-loan-faq__title"><?= esc_html( $title ); ?></h2>
		<?php endif; ?>

		<div class="car-loan-faq__list">
			<?php foreach ( $items as $index => $item ) : ?>
				<?php
				$q = is_array( $item ) ? ( $item['question'] ?? '' ) : '';
				$a = is_array( $item ) ? ( $item['answer'] ?? '' ) : '';
				if ( $q === '' ) {
					continue;
				}
				$item_id = 'car-loan-faq-' . (int) $index;
				?>
				<div class="car-loan-faq__item">
					<button
						type="button"
						class="car-loan-faq__btn"
						aria-expanded="false"
						aria-controls="<?= esc_attr( $item_id ); ?>"
					>
						<span class="car-loan-faq__q"><?= esc_html( $q ); ?></span>
						<span class="car-loan-faq__sign" aria-hidden="true">+</span>
					</button>
					<div id="<?= esc_attr( $item_id ); ?>" class="car-loan-faq__a" hidden>
						<?= esc_html( $a ); ?>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
