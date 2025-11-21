<?php
/**
 * Loan Calculator Settings
 *
 * @package ucredit
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Loan Calculator Settings Class
 */
class Ucredit_Loan_Calculator_Settings {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Add settings page to admin menu
	 */
	public function add_settings_page() {
		add_options_page(
			__( 'Loan Calculator Settings', 'ucredit' ),
			__( 'Loan Calculator', 'ucredit' ),
			'manage_options',
			'loan-calculator-settings',
			array( $this, 'render_settings_page' )
		);
	}

	/**
	 * Register settings
	 */
	public function register_settings() {
		// Register settings
		register_setting(
			'loan_calculator_settings',
			'loan_calculator_annual_rate',
			array(
				'type'              => 'number',
				'sanitize_callback' => array( $this, 'sanitize_rate' ),
				'default'           => 5.5,
			)
		);

		register_setting(
			'loan_calculator_settings',
			'loan_calculator_prime_rate',
			array(
				'type'              => 'number',
				'sanitize_callback' => array( $this, 'sanitize_rate' ),
				'default'           => 1.75,
			)
		);

		register_setting(
			'loan_calculator_settings',
			'loan_calculator_cf7_id',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'absint',
				'default'           => '167',
			)
		);

		register_setting(
			'loan_calculator_settings',
			'loan_calculator_disclaimer',
			array(
				'type'              => 'string',
				'sanitize_callback' => 'wp_kses_post',
				'default'           => 'מחשבון זה מציג הערכה כללית והחישוב נועד להמחשה בלבד ואינו מהווה הצעה מחייבת או התחייבות לקבלת הלוואה. הריבית והתנאים הסופיים משתנים בהתאם לדירוג האשראי האישי ולשיקול דעתה של Ucredit ושל הגוף המממן - <a href="https://ucredit.co.il/privacy-policy/" target="_blank">לתנאי שימוש</a>.',
			)
		);

		// Add settings section
		add_settings_section(
			'loan_calculator_rates_section',
			__( 'Interest Rate Settings', 'ucredit' ),
			array( $this, 'render_section_description' ),
			'loan-calculator-settings'
		);

		// Add settings fields
		add_settings_field(
			'loan_calculator_annual_rate',
			__( 'Annual Interest Rate (%)', 'ucredit' ),
			array( $this, 'render_annual_rate_field' ),
			'loan-calculator-settings',
			'loan_calculator_rates_section'
		);

		add_settings_field(
			'loan_calculator_prime_rate',
			__( 'Prime Interest Rate (%)', 'ucredit' ),
			array( $this, 'render_prime_rate_field' ),
			'loan-calculator-settings',
			'loan_calculator_rates_section'
		);

		// Add settings section for Contact Form 7
		add_settings_section(
			'loan_calculator_form_section',
			__( 'Form Settings', 'ucredit' ),
			array( $this, 'render_form_section_description' ),
			'loan-calculator-settings'
		);

		add_settings_field(
			'loan_calculator_cf7_id',
			__( 'Contact Form 7 ID', 'ucredit' ),
			array( $this, 'render_cf7_id_field' ),
			'loan-calculator-settings',
			'loan_calculator_form_section'
		);

		// Add settings section for Disclaimer
		add_settings_section(
			'loan_calculator_disclaimer_section',
			__( 'Disclaimer Settings', 'ucredit' ),
			array( $this, 'render_disclaimer_section_description' ),
			'loan-calculator-settings'
		);

		add_settings_field(
			'loan_calculator_disclaimer',
			__( 'Calculator Disclaimer', 'ucredit' ),
			array( $this, 'render_disclaimer_field' ),
			'loan-calculator-settings',
			'loan_calculator_disclaimer_section'
		);
	}

	/**
	 * Sanitize rate value
	 *
	 * @param mixed $value The value to sanitize.
	 * @return float
	 */
	public function sanitize_rate( $value ) {
		$value = floatval( $value );

		// Ensure rate is between 0 and 100
		if ( $value < 0 ) {
			$value = 0;
		} elseif ( $value > 100 ) {
			$value = 100;
		}

		return round( $value, 2 );
	}

	/**
	 * Render section description
	 */
	public function render_section_description() {
		echo '<p>' . esc_html__( 'Set the default interest rates for the loan calculator. These values will be used as defaults on all pages where the calculator appears.', 'ucredit' ) . '</p>';
	}

	/**
	 * Render form section description
	 */
	public function render_form_section_description() {
		echo '<p>' . esc_html__( 'Set which Contact Form 7 form will open in the modal when users click the "Apply" button.', 'ucredit' ) . '</p>';
	}

	/**
	 * Render disclaimer section description
	 */
	public function render_disclaimer_section_description() {
		echo '<p>' . esc_html__( 'Customize the disclaimer text that appears below the calculator. You can use HTML for formatting and links.', 'ucredit' ) . '</p>';
	}

	/**
	 * Render annual rate field
	 */
	public function render_annual_rate_field() {
		$value = get_option( 'loan_calculator_annual_rate', 5.5 );
		?>
		<input type="number"
			name="loan_calculator_annual_rate"
			value="<?php echo esc_attr( $value ); ?>"
			step="0.01"
			min="0"
			max="100"
			class="regular-text">
		<p class="description">
			<?php esc_html_e( 'Base annual interest rate (without prime)', 'ucredit' ); ?>
		</p>
		<?php
	}

	/**
	 * Render prime rate field
	 */
	public function render_prime_rate_field() {
		$value = get_option( 'loan_calculator_prime_rate', 1.75 );
		?>
		<input type="number"
			name="loan_calculator_prime_rate"
			value="<?php echo esc_attr( $value ); ?>"
			step="0.01"
			min="0"
			max="100"
			class="regular-text">
		<p class="description">
			<?php esc_html_e( 'Current prime interest rate', 'ucredit' ); ?>
		</p>
		<?php
	}

	/**
	 * Render CF7 ID field
	 */
	public function render_cf7_id_field() {
		$value = get_option( 'loan_calculator_cf7_id', '167' );

		// Get available CF7 forms if plugin is active
		$cf7_forms = array();
		if ( function_exists( 'wpcf7_contact_form' ) && class_exists( 'WPCF7_ContactForm' ) ) {
			$args = array(
				'post_type'      => 'wpcf7_contact_form',
				'posts_per_page' => -1,
				'orderby'        => 'title',
				'order'          => 'ASC',
			);
			$forms = get_posts( $args );

			if ( $forms ) {
				foreach ( $forms as $form ) {
					$cf7_forms[ $form->ID ] = $form->post_title;
				}
			}
		}
		?>

		<?php if ( ! empty( $cf7_forms ) ) : ?>
			<select name="loan_calculator_cf7_id" class="regular-text">
				<?php foreach ( $cf7_forms as $form_id => $form_title ) : ?>
					<option value="<?php echo esc_attr( $form_id ); ?>" <?php selected( $value, $form_id ); ?>>
						<?php echo esc_html( $form_title ); ?> (ID: <?php echo esc_html( $form_id ); ?>)
					</option>
				<?php endforeach; ?>
			</select>
			<p class="description">
				<?php esc_html_e( 'Select the form that will open when users click the "Apply" button.', 'ucredit' ); ?>
			</p>
		<?php else : ?>
			<input type="number"
				name="loan_calculator_cf7_id"
				value="<?php echo esc_attr( $value ); ?>"
				min="1"
				class="small-text">
			<p class="description">
				<?php esc_html_e( 'Enter the Contact Form 7 ID (e.g., 167)', 'ucredit' ); ?>
				<br>
				<em><?php esc_html_e( 'No Contact Form 7 forms found. Make sure the plugin is installed and active.', 'ucredit' ); ?></em>
			</p>
		<?php endif; ?>

		<?php if ( ! empty( $value ) ) : ?>
			<p class="description">
				<strong><?php esc_html_e( 'Full shortcode:', 'ucredit' ); ?></strong>
				<code style="direction: ltr; display: inline-block;">[contact-form-7 id="<?php echo esc_html( $value ); ?>"]</code>
			</p>
		<?php endif; ?>
		<?php
	}

	/**
	 * Render disclaimer field
	 */
	public function render_disclaimer_field() {
		$default_text = 'מחשבון זה מציג הערכה כללית והחישוב נועד להמחשה בלבד ואינו מהווה הצעה מחייבת או התחייבות לקבלת הלוואה. הריבית והתנאים הסופיים משתנים בהתאם לדירוג האשראי האישי ולשיקול דעתה של Ucredit ושל הגוף המממן - <a href="https://ucredit.co.il/privacy-policy/" target="_blank">לתנאי שימוש</a>.';
		$value        = get_option( 'loan_calculator_disclaimer', $default_text );

		// Use wp_editor for WYSIWYG editor
		$editor_settings = array(
			'textarea_name' => 'loan_calculator_disclaimer',
			'textarea_rows' => 8,
			'media_buttons' => false,
			'teeny'         => false,
			'quicktags'     => true,
			'tinymce'       => array(
				'toolbar1' => 'bold,italic,underline,link,unlink,undo,redo',
			),
		);

		wp_editor( $value, 'loan_calculator_disclaimer_editor', $editor_settings );
		?>
		<p class="description">
			<?php esc_html_e( 'This text will appear below the calculator. You can add links and basic formatting.', 'ucredit' ); ?>
		</p>
		<?php
	}

	/**
	 * Render settings page
	 */
	public function render_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Check if settings were saved
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error(
				'loan_calculator_messages',
				'loan_calculator_message',
				__( 'Settings saved successfully', 'ucredit' ),
				'updated'
			);
		}

		// Calculate total rate for display
		$annual_rate = get_option( 'loan_calculator_annual_rate', 5.5 );
		$prime_rate  = get_option( 'loan_calculator_prime_rate', 1.75 );
		$total_rate  = $annual_rate + $prime_rate;
		?>
		<div class="wrap">
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php settings_errors( 'loan_calculator_messages' ); ?>

			<div class="card">
				<h2><?php esc_html_e( 'Current Total Interest Rate', 'ucredit' ); ?></h2>
				<p style="font-size: 24px; font-weight: bold; color: #2271b1;">
					<?php echo esc_html( number_format( $annual_rate, 2 ) ); ?>% +
					<?php echo esc_html( number_format( $prime_rate, 2 ) ); ?>% =
					<span style="color: #d63638;"><?php echo esc_html( number_format( $total_rate, 2 ) ); ?>%</span>
				</p>
			</div>

			<form action="options.php" method="post">
				<?php
				settings_fields( 'loan_calculator_settings' );
				do_settings_sections( 'loan-calculator-settings' );
				submit_button( __( 'Save Changes', 'ucredit' ) );
				?>
			</form>

			<div class="card">
				<h2><?php esc_html_e( 'Shortcode Usage', 'ucredit' ); ?></h2>
				<p><?php esc_html_e( 'Use the following shortcode to display the loan calculator:', 'ucredit' ); ?></p>
				<code style="display: block; padding: 10px; background: #f0f0f1; direction: ltr; text-align: left;">
					[loan_calculator]
				</code>
				<p><?php esc_html_e( 'The calculator will automatically use the interest rates and form you configured here.', 'ucredit' ); ?></p>

				<h3><?php esc_html_e( 'Additional Examples', 'ucredit' ); ?></h3>
				<p><?php esc_html_e( 'With custom interest rates:', 'ucredit' ); ?></p>
				<code style="display: block; padding: 10px; background: #f0f0f1; direction: ltr; text-align: left;">
					[loan_calculator annual_rate="6.0" prime_rate="2.0"]
				</code>

				<p><?php esc_html_e( 'With custom loan amounts:', 'ucredit' ); ?></p>
				<code style="display: block; padding: 10px; background: #f0f0f1; direction: ltr; text-align: left;">
					[loan_calculator min_amount="50000" max_amount="1000000"]
				</code>

				<p><?php esc_html_e( 'With different Contact Form 7:', 'ucredit' ); ?></p>
				<code style="display: block; padding: 10px; background: #f0f0f1; direction: ltr; text-align: left;">
					[loan_calculator cf7_id="123"]
				</code>
			</div>

			<div class="card">
				<h2><?php esc_html_e( 'Contact Form 7 Setup', 'ucredit' ); ?></h2>
				<p><?php esc_html_e( 'For the calculator to pass loan data to the form, add these hidden fields to your Contact Form 7:', 'ucredit' ); ?></p>

				<h3><?php esc_html_e( 'Required Hidden Fields:', 'ucredit' ); ?></h3>
				<code style="display: block; padding: 15px; background: #f0f0f1; direction: ltr; text-align: left; white-space: pre; font-family: monospace;">
[hidden modal_loan_amount]
[hidden modal_loan_term]
[hidden modal_monthly_payment]
[hidden modal_total_payment]
				</code>

				<h3 style="margin-top: 20px;"><?php esc_html_e( 'Complete Form Example:', 'ucredit' ); ?></h3>
				<code style="display: block; padding: 15px; background: #f0f0f1; direction: ltr; text-align: left; white-space: pre; font-family: monospace; font-size: 12px;">
&lt;label&gt;Full Name
[text* modal_name]&lt;/label&gt;

&lt;label&gt;Phone
[tel* modal_phone]&lt;/label&gt;

&lt;label&gt;Email
[email* modal_email]&lt;/label&gt;

[hidden modal_loan_amount]
[hidden modal_loan_term]
[hidden modal_monthly_payment]
[hidden modal_total_payment]

[submit "Submit Application"]
				</code>

				<p style="margin-top: 15px;">
					<strong><?php esc_html_e( 'Note:', 'ucredit' ); ?></strong>
					<?php esc_html_e( 'The hidden fields will be automatically populated with calculator values when the modal opens.', 'ucredit' ); ?>
				</p>

				<?php
				$current_cf7_id = get_option( 'loan_calculator_cf7_id', 167 );
				if ( $current_cf7_id ) :
					?>
					<p style="margin-top: 15px;">
						<a href="<?php echo esc_url( admin_url( 'admin.php?page=wpcf7&post=' . $current_cf7_id . '&action=edit' ) ); ?>"
						   class="button button-primary">
							<?php esc_html_e( 'Edit Current Form', 'ucredit' ); ?> (ID: <?php echo esc_html( $current_cf7_id ); ?>)
						</a>
					</p>
				<?php endif; ?>
			</div>
		</div>

		<style>
			.card {
				max-width: 800px;
				margin: 20px 0;
			}
			.form-table th {
				text-align: left;
			}
			code {
				user-select: all;
			}
		</style>
		<?php
	}

	/**
	 * Get annual rate
	 *
	 * @return float
	 */
	public static function get_annual_rate() {
		return floatval( get_option( 'loan_calculator_annual_rate', 5.5 ) );
	}

	/**
	 * Get prime rate
	 *
	 * @return float
	 */
	public static function get_prime_rate() {
		return floatval( get_option( 'loan_calculator_prime_rate', 1.75 ) );
	}

	/**
	 * Get Contact Form 7 ID
	 *
	 * @return int
	 */
	public static function get_cf7_id() {
		return absint( get_option( 'loan_calculator_cf7_id', 167 ) );
	}

	/**
	 * Get calculator disclaimer
	 *
	 * @return string
	 */
	public static function get_disclaimer() {
		$default_text = 'מחשבון זה מציג הערכה כללית והחישוב נועד להמחשה בלבד ואינו מהווה הצעה מחייבת או התחייבות לקבלת הלוואה. הריבית והתנאים הסופיים משתנים בהתאם לדירוג האשראי האישי ולשיקול דעתה של Ucredit ושל הגוף המממן - <a href="https://ucredit.co.il/privacy-policy/" target="_blank">לתנאי שימוש</a>.';
		return wp_kses_post( get_option( 'loan_calculator_disclaimer', $default_text ) );
	}
}

// Initialize settings
new Ucredit_Loan_Calculator_Settings();

