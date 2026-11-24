<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ucredit
 */

?>

	<?php if ( ! is_page_template( 'templates/car-loan.php' ) ) : ?>
	<footer id="colophon" class="footer">
		<div class="footer__wrap container anim-items">

			<div class="footer__banner">
				<?php $banner = get_field('footer_banner', 'option') ?>

				<?php if ($banner) :?>
					<?php $image = $banner['image']; ?>

					<?php if ($image) : ?>
						<?= wp_get_attachment_image($image, 'medium', '', ['class' => 'footer__banner_img']) ?>
					<?php else : ?>
						<img src="<?= assets('img/footer_baner.svg') ?>" alt="banner" class="footer__banner_img">
					<?php endif; ?> <!-- banner image -->

					<div class="footer__banner_wrap">
						<?php if ($banner['title']) : ?>
							<h3><?= $banner['title'] ?></h3>
						<?php endif; ?> <!-- banner title -->

						<?php if ($banner['description']) : ?>
							<p><?= $banner['description'] ?></p>
						<?php endif; ?> <!-- banner description -->

						<?php $modal = $banner['footer_popup'][0] ? ' modal-show' : ''; ?>
						<?php if ($banner['link']) : ?>
							<a href="<?= $banner['link']['url'] ?>" class="btn btn__bluelight btn__shadow<?= $modal ?>"><?= $banner['link']['title'] ?></a>
						<?php endif; ?> <!-- banner link -->
					</div>
				<?php endif; ?> <!-- banner group -->
			</div>

			<div class="footer__content row">
				<?php
					$first = get_field('first_column', 'option');
				?>
				<?php if ($first) : ?>
					<div class="col-1"><?= $first ?></div>
				<?php endif; ?> <!-- footer text -->
			</div>

			<div class="footer__bottom">
				<?php
					$copyrights = get_field('copyrights', 'option');
					$nav = get_field('navigation', 'option');

					$footer_address = function_exists( 'get_field' ) ? (string) get_field( 'footer_address', 'option' ) : '';
					$footer_phone   = function_exists( 'get_field' ) ? (string) get_field( 'footer_phone', 'option' ) : '';
					$footer_tel_raw = function_exists( 'get_field' ) ? (string) get_field( 'footer_phone_href', 'option' ) : '';

					if ( $footer_address === '' ) {
						$footer_address = 'הבושם 3, אשדוד';
					}
					if ( $footer_phone === '' ) {
						$footer_phone = '03-6525777';
					}
					if ( $footer_tel_raw === '' ) {
						$footer_tel_raw = '+97236525777';
					}

					$footer_tel     = preg_replace( '/[^\d+]/', '', $footer_tel_raw );
					$has_contacts   = ( $footer_address !== '' || ( $footer_phone !== '' && $footer_tel !== '' ) );
					$has_nav        = ! empty( $nav );
				?>

				<div class="copirights" dir="ltr">© כל הזכויות שמורות ל-יוקרדיט 2025 - <a href="/">uCredit</a> | Built by <a href="https://webeffect.co.il/" target="_blank">Webeffect</a></div> <!-- footer copyrights -->

				<nav class="social">
					<?php
						$fb = get_field('facebook', 'option');
						$li = get_field('linkedin', 'option');
						$in = get_field('instagram', 'option');
					?>
					<?php if ($fb) : ?>
						<a href="<?= $fb ?>" class="soc facebook">
							<svg width="8" height="14" viewBox="0 0 8 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M6.3316 2.32458H7.60969V0.0985833C7.38919 0.06825 6.63086 0 5.74769 0C3.90494 0 2.6426 1.15908 2.6426 3.28942V5.25H0.6091V7.7385H2.6426V14H5.13577V7.73908H7.08702L7.39677 5.25058H5.13519V3.53617C5.13577 2.81692 5.32944 2.32458 6.3316 2.32458V2.32458Z" fill="#1A4DBE"/>
							</svg>
						</a>
					<?php endif; ?>

					<?php if ($li) : ?>
						<a href="<?= $li ?>" class="soc linkedin">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M1.866 0.00976562C0.837851 0.00976562 0.000752786 0.846703 0 1.87565C0 2.90461 0.837098 3.7417 1.866 3.7417C2.89452 3.7417 3.73119 2.90461 3.73119 1.87565C3.73119 0.84681 2.89446 0.00976562 1.866 0.00976562Z" fill="#1A4DBE"/>
								<path d="M3.26644 4.49121H0.465321C0.332078 4.49121 0.223999 4.59924 0.223999 4.73259V13.7486C0.223999 13.8818 0.332078 13.9899 0.465321 13.9899H3.26638C3.39968 13.9899 3.50776 13.8818 3.50776 13.7486V4.73259C3.50781 4.59918 3.39973 4.49121 3.26644 4.49121Z" fill="#1A4DBE"/>
								<path d="M10.4274 4.38477C9.40228 4.38477 8.50146 4.6969 7.95176 5.20589V4.73228C7.95176 4.59893 7.84368 4.49091 7.71039 4.49091H5.02342C4.89012 4.49091 4.78204 4.59893 4.78204 4.73228V13.7482C4.78204 13.8815 4.89012 13.9896 5.02342 13.9896H7.82185C7.95515 13.9896 8.06323 13.8815 8.06323 13.7482V9.28761C8.06323 8.00777 8.29864 7.21449 9.47347 7.21449C10.6309 7.21589 10.7176 8.06654 10.7176 9.36407V13.7482C10.7176 13.8815 10.8256 13.9896 10.959 13.9896H13.7587C13.892 13.9896 14 13.8815 14 13.7482V8.8026C14 6.74572 13.5939 4.38477 10.4274 4.38477Z" fill="#1A4DBE"/>
							</svg>
						</a>
					<?php endif; ?>

					<?php if ($in) : ?>
						<a href="<?= $in ?>" class="soc instagram">
							<svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
								<g clip-path="url(#clip0_362_3715)">
									<path d="M7.00232 3.40527C5.01724 3.40527 3.41016 5.01411 3.41016 6.99744C3.41016 8.98252 5.01899 10.5896 7.00232 10.5896C8.98741 10.5896 10.5945 8.98077 10.5945 6.99744C10.5945 5.01236 8.98566 3.40527 7.00232 3.40527ZM7.00232 9.32902C5.71374 9.32902 4.67074 8.28544 4.67074 6.99744C4.67074 5.70944 5.71432 4.66586 7.00232 4.66586C8.29032 4.66586 9.33391 5.70944 9.33391 6.99744C9.33449 8.28544 8.29091 9.32902 7.00232 9.32902Z" fill="#1A4DBE"/>
									<path d="M9.88634 0.0449521C8.59834 -0.0151312 5.40809 -0.0122146 4.11893 0.0449521C2.98609 0.0980355 1.98684 0.371619 1.18126 1.1772C-0.165073 2.52354 0.0070105 4.3377 0.0070105 6.99829C0.0070105 9.72129 -0.144656 11.4935 1.18126 12.8194C2.53284 14.1704 4.37326 13.9936 7.00234 13.9936C9.69968 13.9936 10.6307 13.9954 11.5844 13.6261C12.8812 13.1227 13.86 11.9636 13.9557 9.8817C14.0163 8.59312 14.0128 5.40345 13.9557 4.11429C13.8402 1.6567 12.5213 0.166285 9.88634 0.0449521ZM11.9251 11.9286C11.0425 12.8112 9.81809 12.7325 6.98543 12.7325C4.06876 12.7325 2.89918 12.7756 2.04576 11.9199C1.06284 10.9416 1.24076 9.3707 1.24076 6.98895C1.24076 3.76604 0.910011 1.44495 4.14459 1.27929C4.88776 1.25304 5.10651 1.24429 6.97726 1.24429L7.00351 1.26179C10.1121 1.26179 12.551 0.936285 12.6974 4.17029C12.7307 4.9082 12.7383 5.12987 12.7383 6.9977C12.7377 9.88054 12.7925 11.0571 11.9251 11.9286Z" fill="#1A4DBE"/>
									<path d="M10.7368 4.10363C11.2004 4.10363 11.5762 3.72781 11.5762 3.26422C11.5762 2.80062 11.2004 2.4248 10.7368 2.4248C10.2732 2.4248 9.8974 2.80062 9.8974 3.26422C9.8974 3.72781 10.2732 4.10363 10.7368 4.10363Z" fill="#1A4DBE"/>
								</g>
								<defs>
									<clipPath id="clip0_362_3715">
									<rect width="14" height="14" fill="white"/>
									</clipPath>
								</defs>
							</svg>
						</a>
					<?php endif; ?>
				</nav> <!-- footer social -->

				<?php if ( $has_contacts || $has_nav ) : ?>
					<div class="footer__meta">
						<?php if ( $has_contacts ) : ?>
							<div class="footer__contacts">
								<?php if ( $footer_address !== '' ) : ?>
									<span class="footer__contacts-address">
										<svg class="footer__contacts-icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
											<path d="M7 1.25C4.652 1.25 2.75 3.083 2.75 5.35c0 2.62 3.22 6.46 3.86 7.2a.55.55 0 0 0 .78 0c.64-.74 3.86-4.58 3.86-7.2C11.25 3.083 9.348 1.25 7 1.25Zm0 5.4a1.55 1.55 0 1 1 0-3.1 1.55 1.55 0 0 1 0 3.1Z" fill="#1A4DBE"/>
										</svg>
										<?php esc_html_e( 'כתובת:', 'ucredit' ); ?>
										<?= esc_html( $footer_address ); ?>
									</span>
								<?php endif; ?>
								<?php if ( $footer_phone !== '' && $footer_tel !== '' ) : ?>
									<span class="footer__contacts-phone">
										<svg class="footer__contacts-icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
											<path d="M11.7 9.55c-.7-.35-1.45-.55-1.55-.58-.25-.05-.45 0-.62.18l-.75.88c-.1.12-.28.15-.42.08-1.05-.48-2.05-1.35-2.85-2.35-.8-1-.1.55-2.05-2.85-.08-.14-.05-.32.08-.42l.88-.75c.18-.17.23-.37.18-.62-.03-.1-.23-.85-.58-1.55-.15-.3-.45-.45-.78-.45H3.3c-.55 0-1 .45-1 1 0 4.7 3.8 8.5 8.5 8.5.55 0 1-.45 1-1v-.92c0-.33-.15-.63-.45-.78l-.65-.3Z" fill="#1A4DBE"/>
										</svg>
										<?php esc_html_e( 'טלפון:', 'ucredit' ); ?>
										<a href="<?= esc_url( 'tel:' . $footer_tel ); ?>" dir="ltr"><?= esc_html( $footer_phone ); ?></a>
									</span>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<?php if ( $has_nav ) : ?>
							<nav class="footer__nav">
								<?php foreach ( $nav as $item ) : ?>
									<a href="<?= $item['link']['url'] ?>"><?= $item['link']['title'] ?></a>
								<?php endforeach; ?>
							</nav>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<a href="/" class="site-branding">
					<?php
						$logo = get_field('logo', 'option');
					?>

					<?php if ($logo) : ?>
						<?= wp_get_attachment_image($logo, 'medium', '', ['class' => 'footer__logo']) ?>
					<?php else : ?>
						<img src="<?= assets('img/logo.svg') ?>" alt="" class="footer__logo">
					<?php endif; ?>
				</a><!-- .site-branding -->
			</div>

		</div><!-- .site-info -->
	</footer><!-- #colophon -->
	<?php endif; ?>

	<div id="cf7-response-modal" class="cf7-response-modal">
	    <div class="bg-overlay blue"></div>
		<div class="cf7-response-modal-wrap">
			<button type="button" class="close modal-close">
				<span></span>
				<span></span>
			</button>
			<div class="cf7-response-modal-content"></div>
		</div>
	</div>

	<?php if ( ! is_page_template( 'templates/car-loan.php' ) ) : ?>
	<a href="javascript:void(0)" class="scrollToTop">
		<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><!-- Font Awesome Pro 5.15.4 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) --><path fill="#fff" d="M177 255.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 351.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 425.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1zm-34-192L7 199.7c-9.4 9.4-9.4 24.6 0 33.9l22.6 22.6c9.4 9.4 24.6 9.4 33.9 0l96.4-96.4 96.4 96.4c9.4 9.4 24.6 9.4 33.9 0l22.6-22.6c9.4-9.4 9.4-24.6 0-33.9l-136-136c-9.2-9.4-24.4-9.4-33.8 0z"/></svg>
	</a> <!-- BTN Scroll to TOP -->

	<?php if ( get_field('whatsapp', 'option') ) : ?>
		<a href="https://wa.me/<?= get_field('whatsapp', 'option') ?>" id="whatsapp" target="_blank">
			<img src="<?= assets('img/whatsapp.svg') ?>" alt="whatsapp">
		</a>
	<?php endif; ?> <!-- BTN Whatsapp -->

	<?php get_template_part('template-parts/wizard') ?>
	<?php endif; ?>

<?php wp_footer(); ?>

</body>
</html>
