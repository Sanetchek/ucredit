# Footer contacts

## 2026-11-24 — Address and phone row

- Main footer row above `.footer__bottom`, class `footer__contacts`.
- ACF Options fields in `acf-json/group_63874f30d9b58.json` (Footer tab): `footer_address`, `footer_phone`, `footer_phone_href`.
- Template fallbacks when options empty: `הבושם 3, אשדוד`, `03-6525777`, `+97236525777`.
- Sync via Custom Fields → Sync; then save uCredit Settings if editing live values.
- Smoke: `php tests/smoke/FooterContactsSmokeTest.php`

## 2026-11-24 — Natural redesign

- Contacts moved into `.footer__bottom` inside `.footer__meta` above `.footer__nav`.
- Muted `$N3` text, `$P1` pin/phone icons, hover `$P1` on tel link.
- No orphan band under disclaimer.
