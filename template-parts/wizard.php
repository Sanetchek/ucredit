<?php
/**
 * Loan Wizard popup – texts from ACF Options (uCredit Settings → Loan Wizard).
 */
$wizard_success_title   = get_field( 'wizard_success_title', 'option' ) ?: 'תודה רבה!';
$wizard_success_line1   = get_field( 'wizard_success_line1', 'option' ) ?: 'הפרטים התקבלו בהצלחה';
$wizard_success_line2   = get_field( 'wizard_success_line2', 'option' ) ?: 'נחזור אליכם בהקדם האפשרי';
$wizard_brand           = get_field( 'wizard_brand', 'option' ) ?: 'UCREDIT';
$wizard_tagline         = get_field( 'wizard_tagline', 'option' ) ?: 'הלוואה מהירה לכל מטרה';
$wizard_back_btn        = get_field( 'wizard_back_btn', 'option' ) ?: 'חזור';
$wizard_submit_btn      = get_field( 'wizard_submit_btn', 'option' ) ?: 'בדיקת התאמה חינם';

$wizard_icon_url = get_site_icon_url( 64 );
if ( ! $wizard_icon_url && function_exists( 'get_field' ) ) {
	$logo_id = get_field( 'logo', 'option' );
	if ( $logo_id ) {
		$wizard_icon_url = wp_get_attachment_image_url( $logo_id, 'thumbnail' );
	}
}
?>
<!-- Loan Wizard Modal -->
<div id="wizardOverlay" class="wizard-overlay" onclick="handleOverlayClick(event)">
    <div class="wizard-modal" id="wizardModal">
        <!-- Success Overlay -->
        <div id="successOverlay" class="success-overlay hidden">
            <div class="success-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
            </div>
            <h2 class="success-title"><?php echo esc_html( $wizard_success_title ); ?></h2>
            <p class="success-text">
                <?php echo esc_html( $wizard_success_line1 ); ?><br />
                <?php echo esc_html( $wizard_success_line2 ); ?>
            </p>
        </div>

        <!-- Header -->
        <div class="wizard-header">
            <div class="wizard-logo">
                <div class="wizard-logo-icon">
                    <?php if ( ! empty( $wizard_icon_url ) ) : ?>
                        <img src="<?php echo esc_url( $wizard_icon_url ); ?>" alt="" class="wizard-logo-icon-img" width="32" height="32">
                    <?php else : ?>
                        <span>UC</span>
                    <?php endif; ?>
                </div>
                <div class="wizard-logo-text">
                    <span class="wizard-brand"><?php echo esc_html( $wizard_brand ); ?></span>
                    <span class="wizard-tagline"><?php echo esc_html( $wizard_tagline ); ?></span>
                </div>
            </div>
            <button class="close-btn" onclick="closeWizard()" aria-label="Close">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Progress indicator -->
            <div class="progress-bar">
                <div class="progress-step" data-step="1"></div>
                <div class="progress-step" data-step="2"></div>
                <div class="progress-step" data-step="3"></div>
            </div>

            <!-- Back button -->
            <button id="backButton" class="back-btn hidden" onclick="goBack()">
                <span><?php echo esc_html( $wizard_back_btn ); ?></span>
                <span>&lt;&lt;</span>
            </button>
        </div>

        <!-- Content -->
        <div class="wizard-content" id="wizardContent">
            <!-- Steps will be dynamically inserted here -->
        </div>

        <!-- Footer -->
        <div class="wizard-footer">
            <button id="submitButton" class="btn-submit hidden" onclick="submitForm()">
                <?php echo esc_html( $wizard_submit_btn ); ?>
            </button>
        </div>
    </div>
</div>