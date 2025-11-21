<?php
/**
 * Shortcodes Handler
 *
 * @package ucredit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loan Calculator Shortcode Class
 */
class Ucredit_Loan_Calculator_Shortcode {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'loan_calculator', array( $this, 'render' ) );
	}

	/**
	 * Render the loan calculator shortcode
	 *
	 * @param array $atts Shortcode attributes.
	 * @return string
	 */
	public function render( $atts ) {
		// Get default values from admin settings
		$default_annual_rate = Ucredit_Loan_Calculator_Settings::get_annual_rate();
		$default_prime_rate  = Ucredit_Loan_Calculator_Settings::get_prime_rate();
		$default_cf7_id      = Ucredit_Loan_Calculator_Settings::get_cf7_id();

		// Parse shortcode attributes with defaults
		$atts = shortcode_atts(
			array(
				'annual_rate'     => $default_annual_rate,
				'prime_rate'      => $default_prime_rate,
				'min_amount'      => '10000',
				'max_amount'      => '200000',
				'amount_step'     => '1000',
				'default_amount'  => '100000',
				'min_payment'     => '1000',
				'max_payment'     => '10000',
				'payment_step'    => '100',
				'default_payment' => '3000',
				'cta_text'        => __( 'הגש בקשה להלוואה', 'ucredit' ),
				'cta_url'         => '',
				'enable_modal'    => 'yes',
				'modal_id'        => 'loan_calculator_modal',
				'cf7_id'          => $default_cf7_id,
			),
			$atts,
			'loan_calculator'
		);

		// Sanitize attributes
		$annual_rate     = floatval( $atts['annual_rate'] );
		$prime_rate      = floatval( $atts['prime_rate'] );
		$min_amount      = absint( $atts['min_amount'] );
		$max_amount      = absint( $atts['max_amount'] );
		$amount_step     = absint( $atts['amount_step'] );
		$default_amount  = absint( $atts['default_amount'] );
		$min_payment     = absint( $atts['min_payment'] );
		$max_payment     = absint( $atts['max_payment'] );
		$payment_step    = absint( $atts['payment_step'] );
		$default_payment = absint( $atts['default_payment'] );
		$cta_text        = esc_html( $atts['cta_text'] );
		$cta_url         = esc_url( $atts['cta_url'] );
		$enable_modal    = ( $atts['enable_modal'] === 'yes' ) || ( $atts['enable_modal'] === '1' ) || ( $atts['enable_modal'] === 'true' );
		$modal_id        = sanitize_key( $atts['modal_id'] );
		$cf7_id          = absint( $atts['cf7_id'] );

		// Calculate total rate
		$total_rate = $annual_rate + $prime_rate;

		// Generate unique ID for this calculator instance
		static $calculator_instance = 0;
		$calculator_instance++;
		$unique_id = 'loan-calc-' . $calculator_instance;

		// Determine if we should use modal
		$use_modal = $enable_modal && empty( $cta_url );

		// Start output buffering
		ob_start();
		?>

		<div class="calculator-container" id="<?php echo esc_attr( $unique_id ); ?>" data-modal-id="<?php echo esc_attr( $modal_id ); ?>" data-annual-rate="<?php echo esc_attr( $annual_rate ); ?>" data-prime-rate="<?php echo esc_attr( $prime_rate ); ?>">
			<!-- Hidden inputs for JavaScript to read rates -->
			<input type="hidden" id="annualRate" value="<?php echo esc_attr( $annual_rate ); ?>">
			<input type="hidden" id="primeRate" value="<?php echo esc_attr( $prime_rate ); ?>">

            <div class="calculator-header">
                <h1><?php esc_html_e( 'מחשבון הלוואות', 'ucredit' ); ?></h1>
                <p><?php esc_html_e( 'חשב את ההלוואה שלך בקלות ובמהירות', 'ucredit' ); ?></p>
            </div>

			<div class="calculator-body">

				<div class="calculator-body-inner">
					<div class="mode-toggle">
						<button class="mode-btn active" data-mode="amount"><?php esc_html_e('חישוב לפי סכום הלוואה', 'ucredit'); ?></button>
						<button class="mode-btn" data-mode="payment"><?php esc_html_e('חישוב לפי תשלום חודשי', 'ucredit'); ?></button>
					</div>

					<div id="amountMode" class="input-section">
						<h2><?php esc_html_e( 'בחר את סכום ההלוואה', 'ucredit' ); ?></h2>
						<div class="slider-container">
							<input type="range"
								id="loanAmount"
								min="<?php echo esc_attr( $min_amount ); ?>"
								max="<?php echo esc_attr( $max_amount ); ?>"
								step="<?php echo esc_attr( $amount_step ); ?>"
								value="<?php echo esc_attr( $default_amount ); ?>">
							<div class="slider-labels">
								<span><?php echo esc_html( number_format( $min_amount ) ); ?> ₪</span>
								<span><?php echo esc_html( number_format( $max_amount ) ); ?> ₪</span>
							</div>
						</div>
						<div class="value-display">
							<div class="value-box" id="amountValue"><?php echo esc_html( number_format( $default_amount ) ); ?> ₪</div>
						</div>
					</div>

					<div id="paymentMode" class="input-section" style="display: none;">
						<h2><?php esc_html_e( 'בחר תשלום חודשי', 'ucredit' ); ?></h2>
						<div class="slider-container">
							<input type="range"
								id="monthlyPayment"
								min="<?php echo esc_attr( $min_payment ); ?>"
								max="<?php echo esc_attr( $max_payment ); ?>"
								step="<?php echo esc_attr( $payment_step ); ?>"
								value="<?php echo esc_attr( $default_payment ); ?>">
							<div class="slider-labels">
								<span><?php echo esc_html( number_format( $min_payment ) ); ?> ₪</span>
								<span><?php echo esc_html( number_format( $max_payment ) ); ?> ₪</span>
							</div>
						</div>
						<div class="value-display">
							<div class="value-box" id="paymentValue"><?php echo esc_html( number_format( $default_payment ) ); ?> ₪</div>
						</div>
					</div>

					<div class="input-section">
						<h2><?php esc_html_e( 'מספר תשלומים', 'ucredit' ); ?></h2>
						<div class="slider-container">
							<input type="range"
								id="paymentsGrid"
								min="12"
								max="120"
								step="12"
								value="36">
							<div class="slider-labels">
								<span>12 <?php esc_html_e( 'חודשים', 'ucredit' ); ?></span>
								<span>120 <?php esc_html_e( 'חודשים', 'ucredit' ); ?></span>
							</div>
						</div>
						<div class="value-display">
							<div class="value-box" id="paymentsValue">36 <?php esc_html_e( 'חודשים', 'ucredit' ); ?></div>
						</div>
					</div>

					<div class="calculator-disclaimer calculator-desktop-only">
						<?php echo wp_kses_post(Ucredit_Loan_Calculator_Settings::get_disclaimer()); ?>
					</div>
				</div>

				<div class="results-section">
					<div class="results" id="results">
						<h3><?php esc_html_e( 'תוצאות החישוב', 'ucredit' ); ?></h3>
						<div class="result-row">
							<span class="result-label"><?php esc_html_e( 'סכום הלוואה:', 'ucredit' ); ?></span>
							<span class="result-value" id="resultLoan">0 ₪</span>
						</div>
						<div class="result-row">
							<span class="result-label"><?php esc_html_e( 'תשלום חודשי:', 'ucredit' ); ?></span>
							<span class="result-value" id="resultMonthly">0 ₪</span>
						</div>
						<div class="result-row">
							<span class="result-label"><?php esc_html_e( 'סך הכל לתשלום:', 'ucredit' ); ?></span>
							<span class="result-value secondary" id="resultTotal">0 ₪</span>
						</div>
						<div class="result-row">
							<span class="result-label"><?php esc_html_e( 'סך הכל ריבית:', 'ucredit' ); ?></span>
							<span class="result-value secondary" id="resultInterest">0 ₪</span>
						</div>
						<div class="interest-info">
							<?php esc_html_e( 'ריבית שנתית:', 'ucredit' ); ?> <span id="infoAnnual"><?php echo esc_html( $annual_rate ); ?></span>% +
							<?php esc_html_e( 'פריים:', 'ucredit' ); ?> <span id="infoPrime"><?php echo esc_html( $prime_rate ); ?></span>% =
							<span id="infoTotal"><?php echo esc_html( number_format( $total_rate, 2 ) ); ?></span>%
						</div>
					</div>

					<div class="cta-section">
						<?php if ( $use_modal ) : ?>
							<button class="cta-button loan-calculator-cta modal-show" data-modal="<?php echo esc_attr( $modal_id ); ?>">
								<?php echo esc_html( $cta_text ); ?>
							</button>
						<?php elseif ( ! empty( $cta_url ) ) : ?>
							<a href="<?php echo esc_url( $cta_url ); ?>" class="cta-button loan-calculator-cta">
								<?php echo esc_html( $cta_text ); ?>
							</a>
						<?php else : ?>
							<button class="cta-button loan-calculator-cta">
								<?php echo esc_html( $cta_text ); ?>
							</button>
						<?php endif; ?>
					</div>
				</div>

				<div class="calculator-disclaimer calculator-mobile-only">
					<?php echo wp_kses_post( Ucredit_Loan_Calculator_Settings::get_disclaimer() ); ?>
				</div>
			</div>
		</div>

		<?php
		// If modal is enabled, render the modal
		if ( $use_modal ) {
			$this->render_modal( $modal_id, $cf7_id );
		}

		return ob_get_clean();
	}

	/**
	 * Render the loan application modal
	 *
	 * @param string $modal_id Modal ID.
	 * @param int    $cf7_id Contact Form 7 ID.
	 * @return void
	 */
	private function render_modal( $modal_id, $cf7_id ) {
		?>
		<div id="<?php echo esc_attr( $modal_id ); ?>" class="modal-wrap">
			<div class="bg-overlay blue"></div>

			<section class="modal">
				<button type="button" class="close modal-close">
					<span></span>
					<span></span>
				</button>

				<div class="loan-modal-header">
					<h3><?php esc_html_e( 'בקשה להלוואה', 'ucredit' ); ?></h3>
					<p><?php esc_html_e( 'מלא את הפרטים שלך ונחזור אליך בהקדם', 'ucredit' ); ?></p>
				</div>

				<div class="loan-details-summary">
					<div class="detail-item">
						<span class="detail-label"><?php esc_html_e( 'סכום הלוואה:', 'ucredit' ); ?></span>
						<span class="detail-value" id="modal-loan-amount-display">0 ₪</span>
					</div>
					<div class="detail-item">
						<span class="detail-label"><?php esc_html_e( 'תשלום חודשי:', 'ucredit' ); ?></span>
						<span class="detail-value" id="modal-monthly-payment-display">0 ₪</span>
					</div>
					<div class="detail-item">
						<span class="detail-label"><?php esc_html_e( 'תקופת החזר:', 'ucredit' ); ?></span>
						<span class="detail-value" id="modal-term-display">0 חודשים</span>
					</div>
				</div>

				<?php echo do_shortcode( '[contact-form-7 id="' . $cf7_id . '"]' ); ?>
			</section>
		</div>
		<?php
	}
}

/**
 * Initialize Shortcodes
 */
function ucredit_init_shortcodes() {
	new Ucredit_Loan_Calculator_Shortcode();
}
add_action( 'init', 'ucredit_init_shortcodes' );

