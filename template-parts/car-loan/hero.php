<?php
/**
 * Car loan hero section.
 *
 * @package ucredit
 */

$eyebrow = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_hero_eyebrow' ) : '';
$title   = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_hero_title' ) : '';
$text    = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_hero_text' ) : '';
$cta_p   = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_hero_cta_primary' ) : '';
$cta_wa  = function_exists( 'get_field' ) ? (string) get_field( 'car_loan_hero_cta_whatsapp' ) : '';
$chips   = function_exists( 'get_field' ) ? get_field( 'car_loan_hero_chips' ) : null;
$image   = function_exists( 'get_field' ) ? get_field( 'car_loan_hero_image' ) : null;
$digits  = ucredit_car_loan_phone_digits();

if ( $eyebrow === '' ) {
	$eyebrow = __( 'הלוואה חוץ בנקאית כנגד שעבוד רכב', 'ucredit' );
}
if ( $title === '' ) {
	$title = __( "הרכב שלכם שווה\nעד 250,000 ₪ במזומן", 'ucredit' );
}
if ( $text === '' ) {
	$text = __( 'מקבלים עד 100% משווי הרכב, בלי ערבים ובלי בירוקרטיה – והרכב נשאר אצלכם וממשיך לנסוע כרגיל. אישור עקרוני מהיר, תנאים אישיים והכסף בחשבון תוך 3 ימי עסקים.', 'ucredit' );
}
if ( $cta_p === '' ) {
	$cta_p = __( 'קבלו הצעה תוך דקות', 'ucredit' );
}
if ( $cta_wa === '' ) {
	$cta_wa = __( 'דברו איתנו בוואטסאפ', 'ucredit' );
}
if ( empty( $chips ) || ! is_array( $chips ) ) {
	$chips = ucredit_car_loan_default_chips();
}

$wa_url = 'https://wa.me/972' . ltrim( $digits, '0' );
?>
<section class="car-loan-sec car-loan-hero">
	<div class="car-loan-hero__grid">
		<div class="car-loan-hero__content">
			<?php if ( $eyebrow ) : ?>
				<p class="car-loan-eyebrow"><?= esc_html( $eyebrow ); ?></p>
			<?php endif; ?>

			<?php if ( $title ) : ?>
				<?php
				// ACF textarea with new_lines=br may already contain <br /> tags.
				$title_html = ( false !== strpos( $title, '<' ) )
					? wp_kses_post( $title )
					: nl2br( esc_html( $title ) );
				?>
				<h1 class="car-loan-hero__title"><?= $title_html; ?></h1>
			<?php endif; ?>

			<?php if ( $text ) : ?>
				<p class="car-loan-hero__text"><?= esc_html( $text ); ?></p>
			<?php endif; ?>

			<div class="car-loan-hero__ctas">
				<a href="#lead" class="car-loan-btn car-loan-btn--primary car-loan-btn--lg"><?= esc_html( $cta_p ); ?></a>
				<a href="<?= esc_url( $wa_url ); ?>" class="car-loan-btn car-loan-btn--outline car-loan-btn--lg" target="_blank" rel="noopener noreferrer"><?= esc_html( $cta_wa ); ?></a>
			</div>

			<?php if ( $chips ) : ?>
				<ul class="car-loan-hero__chips">
					<?php foreach ( $chips as $chip ) : ?>
						<?php
						$chip_text = is_array( $chip ) ? ( $chip['text'] ?? '' ) : '';
						if ( $chip_text === '' ) {
							continue;
						}
						?>
						<li class="car-loan-hero__chip"><?= esc_html( $chip_text ); ?></li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		</div>

		<div class="car-loan-hero__media">
			<?php if ( $image ) : ?>
				<?= wp_get_attachment_image( (int) $image, 'large', false, array( 'class' => 'car-loan-hero__img', 'alt' => esc_attr__( 'הלוואה כנגד שעבוד רכב', 'ucredit' ) ) ); ?>
			<?php else : ?>
				<img
					src="https://ucredit.co.il/wp-content/uploads/2025/08/Ucredit_Shiabud_car1-1024x456.jpg"
					alt="<?= esc_attr__( 'הלוואה כנגד שעבוד רכב', 'ucredit' ); ?>"
					class="car-loan-hero__img"
					width="1024"
					height="456"
					loading="eager"
					decoding="async"
				>
			<?php endif; ?>
		</div>
	</div>
</section>
