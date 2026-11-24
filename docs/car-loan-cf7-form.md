# Car Loan — Contact Form 7 markup

Paste into **Contact → Contact Forms → Car** (Form tab).

Then set the form shortcode on the Car Loan page ACF field `car_loan_cf7_shortcode`.

```html
<label class="car-loan-field">שם מלא *
[text* your-name placeholder "שם ושם משפחה"]</label>

<label class="car-loan-field">טלפון *
[tel* your-phone placeholder "050-0000000"]</label>

<label class="car-loan-field">האם יש רכב בבעלותך? *
[select* has-car first_as_label "בחר/י" "כן|yes" "לא|no"]</label>

<label class="car-loan-field">סכום הלוואה נדרש
[select loan-amount first_as_label "בחר/י סכום" "עד 20,000 ₪|20" "20,000–50,000 ₪|50" "50,000–100,000 ₪|100" "100,000–250,000 ₪|250"]</label>

<label class="car-loan-field car-loan-field--full">תקופת החזר
[select loan-term first_as_label "בחר/י תקופה" "עד 24 חודשים|24" "24–60 חודשים|60" "60–100 חודשים|100"]</label>

[acceptance acceptance-consent] אני מאשר/ת קבלת פנייה טלפונית ובדיקת נתוני אשראי לצורך בחינת הבקשה. [/acceptance]

[submit "שלחו לי הצעה"]
```

Use `first_as_label` (not `include_blank`) so the empty option text is Hebrew instead of “—Please choose an option—”.

The theme also rewrites English blank options on the Car Loan template as a fallback.

## Mail tab

The theme rebuilds the Car Loan lead email body in PHP (`ucredit_car_loan_cf7_mail_components`), so a misconfigured Mail tab cannot ship a one-line / mis-mapped lead after deploy.

Optional: paste this into **Mail** so Flamingo / the admin preview match. Leave **Use HTML content type** unchecked.

**Subject** (example):

```
Car Loan – [your-phone]
```

**Message body:**

```
שם: [your-name]
טלפון: [your-phone]
האם יש רכב בבעלותך?: [_raw_has-car]
סכום הלוואה: [_raw_loan-amount]
תקופת החזר: [_raw_loan-term]
הסכמה: [acceptance-consent]
```

Use `[_raw_*]` for piped selects so the mail shows the Hebrew option text (`כן`, `100,000–250,000 ₪`) instead of pipe values (`yes`, `250`). The theme maps pipe values to those labels when it owns the body.

## Lead.im CRM

On `wpcf7_mail_sent`, the theme POSTs the lead to `https://api.lead.im/v2/submit` (`lm_form=122910`, `lm_redirect=no`).

| CF7 field | Lead.im param |
|-----------|---------------|
| `your-name` | `name` |
| `your-phone` | `phone` |
| `loan-term` | `modal_loan_term` |
| `loan-amount` | `fld_286562` |
| `has-car` | `fld_333225` |
| `acceptance-consent` | `divur` (`1`/`0`) |

Also sends `lm_source` (page URL / UTMs from the CF7 submission). `phone2` and `email` are omitted (not on this form). CRM errors are logged and do not block the thank-you UI.
