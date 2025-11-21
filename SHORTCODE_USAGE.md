# UCredit Banner Shortcode - Quick Usage Guide

## 🚀 **Basic Usage**

### **1. Default (uses your ACF fields)**
```
[ucredit_banner]
```
This will show the banner exactly as configured in your theme options.

---

### **2. Custom Content**
```
[ucredit_banner title="Special Offer!" description="Get 20% off today only" link_text="Claim Now" link_url="/offer"]
```

---

### **3. Custom Image**
```
[ucredit_banner image_id="123" title="Custom Banner" description="With custom image"]
```
Replace `123` with your WordPress attachment ID.

---

## 📍 **Where to Use It**

### **In Posts/Pages (Gutenberg/Classic Editor)**
Just paste the shortcode where you want the banner to appear:
```
[ucredit_banner title="Welcome!" description="Thanks for visiting our site"]
```

### **In PHP Templates**
```php
<?= do_shortcode('[ucredit_banner]') ?>

// Or with custom content:
<?= do_shortcode('[ucredit_banner title="Custom Title" description="Custom text"]') ?>
```

### **In Widgets**
Add to any text widget or shortcode widget:
```
[ucredit_banner link_text="Learn More" link_url="/about"]
```

### **In ACF Fields**
If you have ACF text fields that support shortcodes:
```
[ucredit_banner title="Dynamic Content" description="From ACF field"]
```

---

## 🎯 **Real Examples**

### **Promotional Banner**
```
[ucredit_banner title="🎉 Limited Time Offer!" description="Save 30% on all loans this month" link_text="Apply Now" link_url="/apply"]
```

### **Newsletter Signup**
```
[ucredit_banner title="Stay Updated" description="Get the latest financial tips and offers" link_text="Subscribe" link_url="/newsletter"]
```

### **Contact CTA**
```
[ucredit_banner title="Need Help?" description="Our experts are here to assist you" link_text="Contact Us" link_url="/contact"]
```

### **Car Loan Modal**
```
[ucredit_banner title="Car" description="Car loan you can get" link_text="Get Loan" modal="true" modal_id="modal_car" cf7_shortcode="[contact-form-7 id='e890b1e' title='Car']"]
```

---

## ⚙️ **All Available Options**

| Attribute | Example | What it does |
|-----------|---------|--------------|
| `title` | `title="Hello World"` | Sets the banner title |
| `description` | `description="Some text"` | Sets the description |
| `link_text` | `link_text="Click Here"` | Sets button text |
| `link_url` | `link_url="/page"` | Sets button link |
| `image_id` | `image_id="456"` | Sets custom image |
| `modal` | `modal="true"` | Enable modal popup |
| `modal_id` | `modal_id="my_modal"` | Set modal ID |
| `cf7_shortcode` | `cf7_shortcode="[contact-form-7 id='123']"` | Contact form in modal |
| `use_acf` | `use_acf="false"` | Disable ACF fields |

---

## 🔄 **How It Works**

1. **With ACF (default):** Shortcode attributes override ACF field values
2. **Without ACF:** Uses only shortcode attributes
3. **Fallback:** Always shows default banner image if no custom image
4. **Security:** All inputs are properly escaped

---

## 💡 **Pro Tips**

- **Mix and match:** Use some ACF fields and override others
- **Reuse everywhere:** Same banner, multiple locations
- **Dynamic content:** Change content without touching code
- **Consistent styling:** All instances look the same

---

**Ready to use!** Just copy any example above and paste it where you want your banner to appear.

---
---

# Loan Calculator Shortcode - Usage Guide

## 🚀 **Basic Usage**

### **1. Default Calculator**
```
[loan_calculator]
```
This will show the loan calculator with default settings.

---

### **2. Custom Interest Rates**
```
[loan_calculator annual_rate="6.5" prime_rate="2.0"]
```

---

### **3. Custom Loan Amount Range**
```
[loan_calculator min_amount="5000" max_amount="500000" default_amount="150000"]
```

---

### **4. With Admin Panel (Admins Only)**
```
[loan_calculator show_admin="yes"]
```
The admin panel allows logged-in administrators to adjust interest rates in real-time.

---

### **5. With Modal Form (Default)**
```
[loan_calculator enable_modal="yes"]
```
Opens a modal popup with a Contact Form 7 when clicking "Apply". Loan details are automatically pre-filled!

---

### **6. Custom Contact Form 7**
```
[loan_calculator enable_modal="yes" cf7_id="123"]
```
Use your own Contact Form 7 by ID.

---

## 📍 **Where to Use It**

### **In Posts/Pages (Gutenberg/Classic Editor)**
Just paste the shortcode where you want the calculator to appear:
```
[loan_calculator]
```

### **In PHP Templates**
```php
<?= do_shortcode('[loan_calculator]') ?>

// Or with custom settings:
<?= do_shortcode('[loan_calculator annual_rate="5.0" prime_rate="1.5"]') ?>
```

### **In Widgets**
Add to any text widget or shortcode widget:
```
[loan_calculator default_amount="100000"]
```

---

## 🎯 **Real Examples**

### **Personal Loan Calculator (with Modal)**
```
[loan_calculator min_amount="10000" max_amount="200000" default_amount="50000" cta_text="בקש הלוואה אישית" enable_modal="yes"]
```

### **Business Loan Calculator (with Modal)**
```
[loan_calculator min_amount="50000" max_amount="1000000" default_amount="250000" annual_rate="6.0" cta_text="בקש הלוואה לעסק" enable_modal="yes" cf7_id="167"]
```

### **Mortgage Calculator (External Link)**
```
[loan_calculator min_amount="100000" max_amount="2000000" default_amount="500000" annual_rate="4.5" prime_rate="1.5" cta_text="בקש משכנתא" cta_url="/apply-mortgage"]
```

### **Calculator with Admin Controls**
```
[loan_calculator show_admin="yes" annual_rate="5.5" prime_rate="1.75"]
```
*Admin panel will only be visible to logged-in users with 'manage_options' capability.*

### **Full-Featured Example**
```
[loan_calculator
    min_amount="20000"
    max_amount="500000"
    default_amount="100000"
    annual_rate="5.0"
    prime_rate="1.5"
    enable_modal="yes"
    cf7_id="167"
    cta_text="בקש הלוואה עכשיו"
    modal_id="my_loan_modal"]
```

---

## ⚙️ **All Available Options**

| Attribute | Default | Example | What it does |
|-----------|---------|---------|--------------|
| `annual_rate` | `5.5` | `annual_rate="6.0"` | Sets the annual interest rate (%) |
| `prime_rate` | `1.75` | `prime_rate="2.0"` | Sets the prime interest rate (%) |
| `min_amount` | `10000` | `min_amount="5000"` | Minimum loan amount (₪) |
| `max_amount` | `200000` | `max_amount="500000"` | Maximum loan amount (₪) |
| `amount_step` | `1000` | `amount_step="5000"` | Loan amount slider step |
| `default_amount` | `100000` | `default_amount="150000"` | Default loan amount |
| `min_payment` | `1000` | `min_payment="500"` | Minimum monthly payment (₪) |
| `max_payment` | `10000` | `max_payment="20000"` | Maximum monthly payment (₪) |
| `payment_step` | `100` | `payment_step="250"` | Monthly payment slider step |
| `default_payment` | `3000` | `default_payment="5000"` | Default monthly payment |
| `show_admin` | `no` | `show_admin="yes"` | Show admin panel (admins only) |
| `cta_text` | `הגש בקשה להלוואה` | `cta_text="בקש עכשיו"` | Call-to-action button text |
| `cta_url` | *(empty)* | `cta_url="/apply"` | CTA button link URL (disables modal) |
| `enable_modal` | `yes` | `enable_modal="yes"` | Enable modal popup with form |
| `modal_id` | `loan_calculator_modal` | `modal_id="my_modal"` | Unique modal ID |
| `cf7_id` | `167` | `cf7_id="123"` | Contact Form 7 ID for modal |

---

## 🔧 **Features**

### **Dual Calculation Modes**
- **By Loan Amount:** User selects desired loan amount, calculator shows monthly payment
- **By Monthly Payment:** User selects affordable monthly payment, calculator shows available loan amount

### **Interactive Elements**
- Real-time calculations as user adjusts sliders
- Payment term buttons (12, 24, 36, 48, 60 months)
- Formatted currency display (₪)
- Shows total payment and total interest

### **Modal Application Form** ✨ NEW!
- Click "Apply" to open modal popup
- **Automatic pre-fill**: Loan amount, monthly payment, and term are auto-populated
- Integrates with Contact Form 7
- Beautiful gradient summary display
- Smooth animations and responsive design

### **Admin Panel (Optional)**
- Visible only to administrators when `show_admin="yes"`
- Allows real-time adjustment of interest rates
- Automatically updates all calculations

### **RTL Support**
- Fully compatible with Hebrew (RTL) layout
- All text is translatable via `ucredit` text domain

---

## 🔄 **How It Works**

1. **Admin Settings:** Interest rates are managed from **Settings → מחשבון הלוואות** in WordPress admin
2. **JavaScript Integration:** The calculator uses existing JavaScript in `script.js`
3. **Dynamic Calculations:** Uses compound interest formulas for accurate results
4. **Modal Integration:** When clicking "Apply", loan details are captured and auto-filled into the modal form
5. **Form Submission:** Contact Form 7 handles form submission and validation
6. **Responsive Design:** Styled via `loan-amount.scss` and `modal.scss`
7. **Security:** All inputs are sanitized and escaped
8. **Capability Check:** Admin panel and settings require `manage_options` capability

### **Modal Flow:**
```
User adjusts calculator → Clicks "Apply" → Modal opens →
Loan details auto-populate → User fills personal info → Submits
```

---

## ⚙️ **Managing Interest Rates**

### **Global Settings (Recommended)**
Go to **WordPress Admin → Settings → מחשבון הלוואות**

Here you can set defaults that will apply to ALL calculators on your site:

**Interest Rates:**
- ריבית שנתית (%) - Annual interest rate
- ריבית פריים (%) - Prime interest rate

**Contact Form:**
- Contact Form 7 ID - Which form opens in the modal
- Smart dropdown with all your CF7 forms
- Direct link to edit the form
- Form template with required fields

**Benefits:**
- ✅ Change rates once, updates everywhere
- ✅ Change form once, updates everywhere
- ✅ No need to edit shortcodes
- ✅ Easy to manage and maintain
- ✅ Shows total rate calculation
- ✅ Quick access to edit CF7 form

### **Per-Shortcode Override**
You can still override rates for specific calculators:
```
[loan_calculator annual_rate="6.0" prime_rate="2.0"]
```
This will use custom rates instead of the global settings.

---

## 💡 **Pro Tips**

- **Modal by Default:** Modal is enabled by default - just use `[loan_calculator]`
- **Disable Modal:** Set `enable_modal="no"` or provide `cta_url` to use external links instead
- **Custom CTA:** Set `cta_url` to link to your loan application form (disables modal)
- **Multiple Calculators:** Use different `modal_id` for each calculator on the same page
- **Global Rates:** Set interest rates once in admin settings, use everywhere
- **Rate Override:** Use shortcode attributes to override global rates for specific calculators
- **Mobile Friendly:** The calculator and modal are fully responsive and touch-friendly
- **Integration Ready:** Works seamlessly with Contact Form 7

---

## 📋 **Setting Up Contact Form 7 for Loan Applications**

To capture loan details in your Contact Form 7, add these hidden fields:

```
[hidden modal_loan_amount]
[hidden modal_loan_term]
[hidden modal_monthly_payment]
[hidden modal_total_payment]
```

**Full Example Form:**
```
<label>שם מלא
[text* modal_name]</label>

<label>טלפון
[tel* modal_phone]</label>

<label>אימייל
[email* modal_email]</label>

[hidden modal_loan_amount]
[hidden modal_loan_term]
[hidden modal_monthly_payment]
[hidden modal_total_payment]

[submit "שלח בקשה"]
```

These fields will be automatically populated with the calculator values when the modal opens!

---

## 🎨 **Styling**

The calculator uses classes from `loan-amount.scss`. To customize styling, add your CSS overrides in your child theme or custom CSS:

```css
.calculator-container {
    /* Your custom styles */
}

.cta-button {
    /* Custom button styles */
}
```

---

**Ready to calculate!** Just copy any example above and paste it where you want your loan calculator to appear.