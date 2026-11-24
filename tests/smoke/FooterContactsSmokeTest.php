<?php
/**
 * Smoke tests: footer address / phone contact row.
 *
 * Run: php tests/smoke/FooterContactsSmokeTest.php
 *
 * @package ucredit
 */

declare(strict_types=1);

$failed = 0;
$theme_root = dirname( __DIR__, 2 );

/**
 * @param bool   $cond Condition.
 * @param string $msg  Message.
 */
function footer_contacts_smoke_assert( bool $cond, string $msg ): void {
	global $failed;
	if ( $cond ) {
		echo "OK  {$msg}\n";
		return;
	}
	++$failed;
	fwrite( STDERR, "FAIL {$msg}\n" );
}

$options_json_path = $theme_root . '/acf-json/group_63874f30d9b58.json';
footer_contacts_smoke_assert(
	is_file( $options_json_path ),
	'Options ACF JSON exists'
);

$options_json = (string) file_get_contents( $options_json_path );
footer_contacts_smoke_assert(
	false !== strpos( $options_json, '"name": "footer_address"' ),
	'Options JSON defines footer_address'
);
footer_contacts_smoke_assert(
	false !== strpos( $options_json, '"name": "footer_phone"' ),
	'Options JSON defines footer_phone'
);
footer_contacts_smoke_assert(
	false !== strpos( $options_json, '"name": "footer_phone_href"' ),
	'Options JSON defines footer_phone_href'
);
footer_contacts_smoke_assert(
	false !== strpos( $options_json, 'הבושם 3, אשדוד' ),
	'Options JSON default address is הבושם 3, אשדוד'
);
footer_contacts_smoke_assert(
	false !== strpos( $options_json, '+97236525777' ),
	'Options JSON default tel href is +97236525777'
);

$footer = (string) file_get_contents( $theme_root . '/footer.php' );
footer_contacts_smoke_assert(
	false !== strpos( $footer, "get_field( 'footer_address', 'option' )" ),
	'footer.php reads footer_address option'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, "get_field( 'footer_phone', 'option' )" ),
	'footer.php reads footer_phone option'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, "get_field( 'footer_phone_href', 'option' )" ),
	'footer.php reads footer_phone_href option'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, 'footer__meta' ),
	'footer.php renders footer__meta wrapper'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, 'footer__contacts' ),
	'footer.php renders footer__contacts'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, 'aria-hidden="true"' ),
	'footer.php marks decorative contact icons aria-hidden'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, 'הבושם 3, אשדוד' ),
	'footer.php falls back to address הבושם 3, אשדוד'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, '+97236525777' ),
	'footer.php falls back to tel +97236525777'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, "esc_url( 'tel:' . \$footer_tel )" ),
	'footer.php builds escaped tel: href'
);
footer_contacts_smoke_assert(
	false !== strpos( $footer, 'esc_html( $footer_address )' )
		|| false !== strpos( $footer, 'esc_html( $footer_address );' ),
	'footer.php escapes address output'
);

$meta_pos     = strpos( $footer, 'footer__meta' );
$contacts_pos = strpos( $footer, 'footer__contacts' );
$nav_pos      = strpos( $footer, 'footer__nav' );
footer_contacts_smoke_assert(
	false !== $meta_pos && false !== $contacts_pos && false !== $nav_pos
		&& $meta_pos < $contacts_pos && $contacts_pos < $nav_pos,
	'footer.php stacks contacts above nav inside footer__meta'
);

$scss = (string) file_get_contents( $theme_root . '/assets/scss/footer.scss' );
footer_contacts_smoke_assert(
	false !== strpos( $scss, '&__meta' ),
	'footer.scss styles footer__meta'
);
footer_contacts_smoke_assert(
	false !== strpos( $scss, '&__contacts' ),
	'footer.scss styles footer__contacts'
);
footer_contacts_smoke_assert(
	false !== strpos( $scss, 'color: $N3' ),
	'footer.scss uses muted $N3 for contacts'
);

$style = (string) file_get_contents( $theme_root . '/style.css' );
footer_contacts_smoke_assert(
	false !== strpos( $style, '.footer__meta' ),
	'compiled style.css includes .footer__meta'
);
footer_contacts_smoke_assert(
	false !== strpos( $style, '.footer__contacts' ),
	'compiled style.css includes .footer__contacts'
);

if ( $failed > 0 ) {
	fwrite( STDERR, "\n{$failed} footer contacts smoke assertion(s) failed.\n" );
	exit( 1 );
}

echo "\nAll footer contacts smoke assertions passed.\n";
exit( 0 );
