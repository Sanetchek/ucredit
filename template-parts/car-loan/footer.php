<?php
/**
 * Car loan legal footer.
 *
 * @package ucredit
 */

$logo_id     = function_exists( 'get_field' ) ? get_field( 'car_loan_logo' ) : null;
$links       = function_exists( 'get_field' ) ? get_field( 'car_loan_footer_links' ) : null;
$disclosure  = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_footer_disclosure' ) : '';
$copy        = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_footer_copy' ) : '';
$phone       = ucredit_car_loan_phone_display();
$digits      = ucredit_car_loan_phone_digits();

if ( empty( $links ) || ! is_array( $links ) ) {
	$links = ucredit_car_loan_default_footer_links();
}
if ( $disclosure === '' ) {
	$disclosure = __( 'גילוי נאות: ההלוואות ניתנות ללקוחות כל הבנקים, מעל גיל 18. תקופת ההלוואה 12–100 חודשים. הריבית השנתית נקבעת בהתאם לחיווי הפיננסי של מבקש ההלוואה. קבלת האשראי מותנית בהגשת בקשה, ומועמדת לפי שיקול דעתו המוחלט של הגורם המלווה ובכפוף לתנאיו. הפרסום אינו מהווה הצעה למתן אשראי. אי עמידה בפירעון ההלוואה עלולה לגרור חיוב בריבית פיגורים והליכי הוצאה לפועל, ובהלוואה כנגד שעבוד רכב – מימוש השעבוד. לשם בחינת הבקשה, הגורם המממן רשאי לפנות ללשכת אשראי לקבלת חיווי אשראי לגביך, ולשכת האשראי תגיש לבנק ישראל בקשה לקבלת נתוני האשראי הכלולים במאגר נתוני אשראי לגביך.', 'ucredit' );
}
if ( $copy === '' ) {
	$copy = __( '© כל הזכויות שמורות ל-יוקרדיט 2026 · UCredit — הלוואה לכל מטרה', 'ucredit' );
}
?>
<footer class="car-loan-sec car-loan-footer">
	<div class="car-loan-footer__inner">
		<div class="car-loan-footer__top">
			<?php if ( $logo_id ) : ?>
				<?= wp_get_attachment_image( (int) $logo_id, 'medium', false, array( 'class' => 'car-loan-footer__logo', 'alt' => 'UCredit' ) ); ?>
			<?php else : ?>
				<img src="<?= esc_url( assets( 'img/Ucredit_logo_Hebrew.png' ) ); ?>" alt="UCredit" class="car-loan-footer__logo" width="140" height="40">
			<?php endif; ?>

			<nav class="car-loan-footer__nav" aria-label="<?= esc_attr__( 'קישורים משפטיים', 'ucredit' ); ?>">
				<?php foreach ( $links as $row ) : ?>
					<?php
					$link = is_array( $row ) ? ( $row['link'] ?? null ) : null;
					if ( empty( $link ) || empty( $link['url'] ) ) {
						continue;
					}
					?>
					<a href="<?= esc_url( $link['url'] ); ?>"><?= esc_html( $link['title'] ?? '' ); ?></a>
				<?php endforeach; ?>
				<a href="tel:<?= esc_attr( $digits ); ?>" dir="ltr"><?= esc_html( $phone ); ?></a>
			</nav>
		</div>

		<?php if ( $disclosure ) : ?>
			<p class="car-loan-footer__disclosure"><?= esc_html( $disclosure ); ?></p>
		<?php endif; ?>

		<?php if ( $copy ) : ?>
			<div class="car-loan-footer__copy"><?= esc_html( $copy ); ?></div>
		<?php endif; ?>
	</div>
</footer>
