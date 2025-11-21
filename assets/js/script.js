(function ($) {
	/**
	 * Preloader
	 */
	$(window).ready(function () {
		setTimeout(function () {
			$('#preloader').css('display', 'none');
		}, 300);
	});

	/**
	 * Scroll to top
	 */
	$(window).on('scroll', function () {
		const windowTop = $(this).scrollTop();

		if (windowTop > 300) {
			$('.scrollToTop').addClass('active');
			$('.header').addClass('active');
		} else {
			$('.scrollToTop').removeClass('active');
			$('.header').removeClass('active');
		}
	});

	/**
	 * Scroll to top
	 * @param {*} params
	 * @returns
	 */
	$('.scrollToTop').on('click', function () {
		window.scrollTo({
			top: 0,
			behavior: 'smooth'
		});
	});

	/**
	 * Modal Show
	 */
	$('.modal-show').on('click', function (e) {
		e.preventDefault();
		const modalId = $(this).data('modal') || 'modal';

		$(`#${ modalId }`).fadeIn();
	});

	/**
	 * Modal Close
	 */
	$('.modal-close, .bg-overlay').on('click', function (e) {
		e.preventDefault();
		const modalWrap = $(this).closest('.modal-wrap');

		$(modalWrap).fadeOut();
	});

	/**
	 * Modal Close by ESC key
	 */
	$('body').on('keyup', function (e) {
		if (e.keyCode == 27) {
			$('#modal, #cf7-response-modal, .bg-overlay').fadeOut();
		}
	});

	/**
	 * Contact Form 7 submit
	 */
	document.addEventListener('wpcf7mailsent', function (event) {
		const message = event.detail.apiResponse.message;

		const formId = event.detail.contactFormId;
		const formIdString = String(formId);

		// Handle form ID "35ee935" (Car loan page)
		if (formIdString) {
			// Close any open modals
			$('.modal-close').click();

			// Update URL with hash parameter
			const currentUrl = window.location.href.split('#')[0]; // Remove existing hash
			const newUrl = currentUrl + '#thank-you';
			window.history.pushState(null, '', newUrl);

			// Show thank you popup with Hebrew message
			const thankYouMessage = '<div class="thank-you-message-834">' + 'תודה על פנייתכם נציגנו יחזרו אליכם בהקדם' + '</div>';
			cf7ResponseModalOpen(thankYouMessage);
			return;
		}

		// Handle other forms (167, 775)
		if (!formId || (formId !== 167 && formId !== 775)) {
			return;
		}

		if (formId === 167) {
			cf7HandleForm167(event);
		}

		$('.modal-close').click();
		cf7ResponseModalOpen(message);
	}, false);

	$('#cf7-response-modal .bg-overlay,#cf7-response-modal .modal-close').on('click', function () {
		cf7ResponseModalClose();
	});

	function cf7ResponseModalOpen(message) {
		$('#cf7-response-modal .cf7-response-modal-content').html(message);
		$('#cf7-response-modal').fadeIn();

		// Thank You Page Pixel - Conversion Tracking
		!function(f,b,n){
			if(f.ctq)return;
			n=f.ctq=function(){
				n.callMethod?
				n.callMethod.apply(n,arguments):n.queue.push(arguments)
			};
			if(!f._ctq)f._ctq=n;
			n.push=n;
			n.loaded=!0;
			n.version='1.0';
			n.queue=[];
		}(window, document);
		ctq('init', '01kae1aap63xy5rqvbf10dp1x5');
		ctq('track', 'Lead');
	}

	function cf7ResponseModalClose() {
		$('#cf7-response-modal').fadeOut();
	}

	function cf7HandleForm167(event) {
		const form = event.detail.inputs;
		let array = [];

		$(form).each((i, item) => {
			array[item.name] = item.value;
		});

		// Defensive: only run replace if value exists and is a string, fallback safely
		if (typeof array['modal_phone'] === 'string') {
			array['modal_phone'] = array['modal_phone'].split(' ').join('');
		} else {
			array['modal_phone'] = '';
		}

		const URL = `https://clients.frontask.co.il/52922/Pages/Utilities/WebToLead.aspx?type=get&FirstName=${ array[ 'modal_name' ] }&MobilePhone=${ array[ 'modal_phone' ] }&Email=${ array[ 'modal_email' ] }&MailingList=1&P-CN46a03780_1345_4bab_be1b_571bde9b624c=web_ucredit&P-CN6983c614_d21f_44b6_9f36_31672c31c262=${ array[ 'modal_loan_amount' ] }&P-CNa529642d_9cee_4b37_a473_f28ff271e4ad=${ array[ 'modal_loan_term' ] }&P-CN66dc07cc_4a96_4981_af20_f74b3618426d=${ array[ 'modal_select' ] }&SystemID=95ae5843-8c2b-406a-bff5-2ee92ced222b&ProcessDefinitionStepID=PP60400279_0B8F_41F8_ABCC_15834568F4BE&UpdateExistingDetails=0`;

		fetch(URL, {
			mode: 'no-cors',
		});
	}

	/**
	 * Animate Items
	 */
	const animItems = $('.anim-items')

	if (animItems.length > 0) {
		$(window).on('scroll', animOnScroll);

		function animOnScroll(params) {
			for (let index = 0; index < animItems.length; index++) {
				const item = animItems[index];
				const itemHeight = item.offsetHeight;
				const itemOffset = offset(item).top;

				// Different animation trigger points for mobile vs desktop
				let animStart = 20;

				// Special case for footer on mobile - make it appear much earlier
				if (window.innerWidth <= 768 && $(item).closest('.footer').length > 0) {
					animStart = 100; // Trigger when footer is 1/1.2 viewport height away (much earlier)
				}

				let animItemPoint = window.innerHeight - itemHeight / animStart;

				if (itemHeight > window.innerHeight) {
					animItemPoint = window.innerHeight - window.innerHeight / animStart;
				}

				if ((pageYOffset > itemOffset - animItemPoint) && pageYOffset < (itemOffset + itemHeight)) {
					$(item).addClass('active');
				}
			}
		}
	}

	/**
	 * Scroll Params
	 * @param {*} el
	 * @returns
	 */
	function offset(el) {
		const rect = el.getBoundingClientRect();
		const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
		const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

		return {
			top: rect.top + scrollTop,
			left: rect.left + scrollLeft
		}
	}

	// Burger menu change style
	$('.burger-menu').on('click', function () {
		$(this).toggleClass('change');
		$('.main-navigation').slideToggle();
	});

	/**
	 * Mobile Sub-menu Toggle
	 */
	$('.has-submenu > a').on('click', function (e) {
		if ($(window).width() <= 992) {
			e.preventDefault();
			const $parent = $(this).parent();
			const $submenu = $parent.find('> .sub-menu');

			// Close other open sub-menus at the same level
			$parent.siblings('.has-submenu').removeClass('submenu-open');
			$parent.siblings('.has-submenu').find('.sub-menu').removeClass('submenu-open');

			// Toggle current sub-menu
			$parent.toggleClass('submenu-open');

			// Add smooth animation
			if ($parent.hasClass('submenu-open')) {
				$submenu.css('max-height', $submenu[0].scrollHeight + 'px');
			} else {
				$submenu.css('max-height', '0');
			}
		}
	});

	/**
	 * Close mobile menu when clicking outside
	 */
	$(document).on('click', function (e) {
		if ($(window).width() <= 992) {
			if (!$(e.target).closest('.main-navigation, .burger-menu').length) {
				$('.burger-menu').removeClass('change');
				$('.main-navigation').slideUp();
				// Close all sub-menus
				$('.has-submenu').removeClass('submenu-open');
				$('.sub-menu').css('max-height', '0');
			}
		}
	});

	/**
	 * Handle window resize to reset mobile menu state
	 */
	$(window).on('resize', function () {
		if ($(window).width() > 992) {
			$('.burger-menu').removeClass('change');
			$('.main-navigation').show();
			$('.has-submenu').removeClass('submenu-open');
			$('.sub-menu').css('max-height', '');
		}
	});

	/**
	 *	FAQ Tabs
	 */
	$('.faq__open').on('click', function () {
		const container = $(this).closest('.faq__tab');

		if (!$(this).hasClass('active')) {
			$('.faq__tab_answer').slideUp();
			$('.faq__open').removeClass('active');
			$(this).addClass('active');
			$(container).find('.faq__tab_answer').slideDown();
		} else {
			$(this).removeClass('active');
			$(container).find('.faq__tab_answer').slideUp();
		}
	});

	/**
	 * Posts Filter System
	 */
	if ($('.posts-filter-container').length > 0) {
		const PostsFilter = {
			init: function () {
				this.bindEvents();
				this.currentPage = 1;
				this.currentFilters = {
					search: '',
					category: '',
					sort: 'date-desc'
				};
				this.loading = false;
			},

			bindEvents: function () {
				// Search input with debounce
				let searchTimeout;
				$('#search-filter').on('input', function () {
					clearTimeout(searchTimeout);
					searchTimeout = setTimeout(() => {
						PostsFilter.currentFilters.search = $(this).val();
						PostsFilter.currentPage = 1;
						PostsFilter.loadPosts();
					}, 500);
				});

				// Category filter
				$('#category-filter').on('change', function () {
					PostsFilter.currentFilters.category = $(this).val();
					PostsFilter.currentPage = 1;
					PostsFilter.loadPosts();
				});

				// Sort filter
				$('#sort-filter').on('change', function () {
					PostsFilter.currentFilters.sort = $(this).val();
					PostsFilter.currentPage = 1;
					PostsFilter.loadPosts();
				});

				// Clear filters
				$('#clear-filters').on('click', function () {
					PostsFilter.clearFilters();
				});

				// Load more
				$('#load-more-btn').on('click', function () {
					PostsFilter.loadMore();
				});

				// Reset search
				$('#reset-search').on('click', function () {
					PostsFilter.clearFilters();
				});
			},

			loadPosts: function () {
				if (this.loading) return;

				this.loading = true;
				this.showLoading();

				const formData = new FormData();
				formData.append('action', 'ucredit_filter_posts');
				formData.append('nonce', ucredit_ajax.nonce);
				formData.append('search', this.currentFilters.search);
				formData.append('category', this.currentFilters.category);
				formData.append('sort', this.currentFilters.sort);
				formData.append('page', this.currentPage);

				fetch(ucredit_ajax.ajax_url, {
						method: 'POST',
						body: formData
					})
					.then(response => response.json())
					.then(data => {
						if (data.success) {
							this.renderPosts(data);
							this.updateActiveFilters();
							this.updateLoadMore(data);
						}
					})
					.catch(error => {
						console.error('Error loading posts:', error);
						this.showError();
					})
					.finally(() => {
						this.loading = false;
						this.hideLoading();
					});
			},

			renderPosts: function (data) {
				const postsGrid = $('#posts-grid');

				if (this.currentPage === 1) {
					postsGrid.empty();
				}

				if (data.posts.length === 0) {
					this.showNoResults();
					return;
				}

				this.hideNoResults();

				data.posts.forEach(post => {
					// Use the HTML that comes from the PHP template
					postsGrid.append(post.html);
				});

				// Update counts
				$('#current-count').text(Math.min(this.currentPage * 12, data.total_posts));
				$('#total-count').text(data.total_posts);
			},




			loadMore: function () {
				this.currentPage++;
				this.loadPosts();
			},

			clearFilters: function () {
				$('#search-filter').val('');
				$('#category-filter').val('');
				$('#sort-filter').val('date-desc');

				this.currentFilters = {
					search: '',
					category: '',
					sort: 'date-desc'
				};

				this.currentPage = 1;
				this.loadPosts();
			},

			updateActiveFilters: function () {
				const activeFilters = $('#active-filters');
				const activeFilterTags = $('#active-filter-tags');
				const filters = [];

				if (this.currentFilters.search) {
					filters.push(`<span class="filter-tag">${ucredit.translations.search}: "${this.currentFilters.search}" <button type="button" class="remove-filter" data-filter="search">×</button></span>`);
				}

				if (this.currentFilters.category) {
					const categoryName = $('#category-filter option:selected').text();
					filters.push(`<span class="filter-tag">${ucredit.translations.category}: ${categoryName} <button type="button" class="remove-filter" data-filter="category">×</button></span>`);
				}

				if (filters.length > 0) {
					activeFilterTags.html(filters.join(''));
					activeFilters.show();

					// Bind remove filter events
					$('.remove-filter').on('click', function () {
						const filterType = $(this).data('filter');
						PostsFilter.removeFilter(filterType);
					});
				} else {
					activeFilters.hide();
				}
			},

			removeFilter: function (filterType) {
				switch (filterType) {
					case 'search':
						$('#search-filter').val('');
						this.currentFilters.search = '';
						break;
					case 'category':
						$('#category-filter').val('');
						this.currentFilters.category = '';
						break;
				}

				this.currentPage = 1;
				this.loadPosts();
			},

			updateLoadMore: function (data) {
				const loadMoreContainer = $('#load-more-container');

				if (data.has_more) {
					loadMoreContainer.show();
				} else {
					loadMoreContainer.hide();
				}
			},

			showLoading: function () {
				$('#loading-indicator').show();
			},

			hideLoading: function () {
				$('#loading-indicator').hide();
			},

			showNoResults: function () {
				$('#no-results').show();
				$('#load-more-container').hide();
			},

			hideNoResults: function () {
				$('#no-results').hide();
			},

			showError: function () {
				$('#posts-grid').html(`<div class="error-message"><p>${ucredit.translations.error_loading_posts}</p></div>`);
			}
		};

		// Initialize posts filter
		PostsFilter.init();
	}
}(jQuery));

/**
 * Loan Amount Calculator
 */
if (document.getElementById('paymentsGrid')) {
	// Get rates from hidden inputs (set from admin settings)
	const annualRateInput = document.getElementById('annualRate');
	const primeRateInput = document.getElementById('primeRate');
	const initialAnnualRate = parseFloat(annualRateInput ? annualRateInput.value : 5.5) || 5.5;
	const initialPrimeRate = parseFloat(primeRateInput ? primeRateInput.value : 1.75) || 1.75;

	const state = {
		mode: 'amount',
		loanAmount: 100000,
		monthlyPayment: 3000,
		numPayments: 36,
		annualRate: initialAnnualRate,
		primeRate: initialPrimeRate
	};

	function init() {
		// Move modal outside of anim-items container to prevent transform conflicts
		moveModalToBody();
		attachEventListeners();
		updateMaxPaymentTerm();
		calculate();
	}

	function moveModalToBody() {
		const calculator = document.querySelector('.calculator-container');
		if (!calculator) return;

		const modalId = calculator.dataset.modalId;
		if (!modalId) return;

		const modal = document.getElementById(modalId);
		if (modal && modal.parentElement !== document.body) {
			document.body.appendChild(modal);
		}
	}

	function attachEventListeners() {
		const modeBtns = document.querySelectorAll('.mode-btn');
		for (let i = 0; i < modeBtns.length; i++) {
			modeBtns[i].addEventListener('click', function () {
				const allBtns = document.querySelectorAll('.mode-btn');
				for (let j = 0; j < allBtns.length; j++) {
					allBtns[j].classList.remove('active');
				}
				this.classList.add('active');
				state.mode = this.getAttribute('data-mode');
				toggleMode();
				updateMaxPaymentTerm();
				calculate();
			});
		}

		document.getElementById('loanAmount').addEventListener('input', function (e) {
			state.loanAmount = parseInt(e.target.value);
			updateSliderDisplay();
			calculate();
		});

		document.getElementById('monthlyPayment').addEventListener('input', function (e) {
			state.monthlyPayment = parseInt(e.target.value);
			updateSliderDisplay();
			updateMaxPaymentTerm();
			calculate();
		});

		document.getElementById('paymentsGrid').addEventListener('input', function (e) {
			state.numPayments = parseInt(e.target.value);
			updatePaymentsDisplay();
			calculate();
		});

		// Annual and Prime rate inputs are now hidden (managed from admin)
		// No event listeners needed
	}

	function toggleMode() {
		const amountMode = document.getElementById('amountMode');
		const paymentMode = document.getElementById('paymentMode');

		if (state.mode === 'amount') {
			amountMode.style.display = 'block';
			paymentMode.style.display = 'none';
		} else {
			amountMode.style.display = 'none';
			paymentMode.style.display = 'block';
		}
	}

	function updateSliderDisplay() {
		if (state.mode === 'amount') {
			document.getElementById('amountValue').textContent = formatCurrency(state.loanAmount);
		} else {
			document.getElementById('paymentValue').textContent = formatCurrency(state.monthlyPayment);
		}
	}

	function updatePaymentsDisplay() {
		document.getElementById('paymentsValue').textContent = state.numPayments + ' חודשים';
	}

	function updateMaxPaymentTerm() {
		const paymentsSlider = document.getElementById('paymentsGrid');
		const loanAmountSlider = document.getElementById('loanAmount');

		if (!paymentsSlider || !loanAmountSlider) {
			return;
		}

		const maxLoanAmount = parseInt(loanAmountSlider.max);
		let maxMonths = 120; // Default maximum

		if (state.mode === 'payment') {
			// Calculate max months based on monthly payment
			// Simple calculation: maxLoan / monthlyPayment (basis amount without considering interest)
			const payment = state.monthlyPayment;

			// Calculate basis months: how many months to reach 200K principal
			const basisMonths = Math.floor(maxLoanAmount / payment);

			// Round UP to nearest 12-month increment to be more permissive
			maxMonths = Math.min(120, Math.ceil(basisMonths / 12) * 12);

			// Ensure at least 12 months
			if (maxMonths < 12) {
				maxMonths = 12;
			}
		}

		// Update slider max value
		paymentsSlider.max = maxMonths;

		// Update max label
		const sliderLabels = paymentsSlider.parentElement.querySelector('.slider-labels');
		if (sliderLabels) {
			const maxLabel = sliderLabels.querySelector('span:last-child');
			if (maxLabel) {
				maxLabel.textContent = maxMonths + ' חודשים';
			}
		}

		// If current value exceeds new max, adjust it
		if (state.numPayments > maxMonths) {
			state.numPayments = maxMonths;
			paymentsSlider.value = maxMonths;
			updatePaymentsDisplay();
			calculate();
		}
	}

	function updateTotalRate() {
		const total = state.annualRate + state.primeRate;
		const infoAnnual = document.getElementById('infoAnnual');
		const infoPrime = document.getElementById('infoPrime');
		const infoTotal = document.getElementById('infoTotal');

		if (infoAnnual) infoAnnual.textContent = state.annualRate.toFixed(2);
		if (infoPrime) infoPrime.textContent = state.primeRate.toFixed(2);
		if (infoTotal) infoTotal.textContent = total.toFixed(2);
	}

	function calculateMonthlyPayment(principal, months) {
		const totalRate = state.annualRate + state.primeRate;
		const monthlyRate = totalRate / 100 / 12;

		if (monthlyRate === 0) {
			return principal / months;
		}

		const payment = principal * (monthlyRate * Math.pow(1 + monthlyRate, months)) / (Math.pow(1 + monthlyRate, months) - 1);

		return payment;
	}

	function calculateLoanAmount(payment, months) {
		const totalRate = state.annualRate + state.primeRate;
		const monthlyRate = totalRate / 100 / 12;

		if (monthlyRate === 0) {
			return payment * months;
		}

		const principal = payment * (Math.pow(1 + monthlyRate, months) - 1) / (monthlyRate * Math.pow(1 + monthlyRate, months));

		return principal;
	}

	function calculate() {
		let loanAmount;
		let monthlyPayment;
		let totalPayment;
		let totalInterest;

		if (state.mode === 'amount') {
			loanAmount = state.loanAmount;
			monthlyPayment = calculateMonthlyPayment(loanAmount, state.numPayments);
		} else {
			monthlyPayment = state.monthlyPayment;
			loanAmount = calculateLoanAmount(monthlyPayment, state.numPayments);
		}

		totalPayment = monthlyPayment * state.numPayments;
		totalInterest = totalPayment - loanAmount;

		document.getElementById('resultLoan').textContent = formatCurrency(loanAmount);
		document.getElementById('resultMonthly').textContent = formatCurrency(monthlyPayment);
		document.getElementById('resultTotal').textContent = formatCurrency(totalPayment);
		document.getElementById('resultInterest').textContent = formatCurrency(totalInterest);
	}

	function formatCurrency(amount) {
		return Math.round(amount).toLocaleString('he-IL') + ' ₪';
	}

	/**
	 * Loan Calculator Modal Integration (Pure JS)
	 */
	document.addEventListener('click', function (e) {
		if (!e.target.classList.contains('loan-calculator-cta') || !e.target.classList.contains('modal-show')) {
			return;
		}

		const calculator = e.target.closest('.calculator-container');
		const modalId = calculator ? calculator.dataset.modalId : null;

		if (!modalId || !window.loanCalculatorState) {
			return;
		}

		const state = window.loanCalculatorState;
		const mode = state.mode;

		// Helper functions (define first)
		function calculateMonthlyPayment(principal, months) {
			const annualRateEl = document.getElementById('annualRate');
			const primeRateEl = document.getElementById('primeRate');
			const annualRate = parseFloat(annualRateEl ? annualRateEl.value : 5.5) || 5.5;
			const primeRate = parseFloat(primeRateEl ? primeRateEl.value : 1.75) || 1.75;
			const totalRate = (annualRate + primeRate) / 100;
			const monthlyRate = totalRate / 12;

			if (monthlyRate === 0) {
				return principal / months;
			}

			const payment = principal * (monthlyRate * Math.pow(1 + monthlyRate, months)) / (Math.pow(1 + monthlyRate, months) - 1);

			return payment;
		}

		function calculateLoanAmount(payment, months) {
			const annualRateEl = document.getElementById('annualRate');
			const primeRateEl = document.getElementById('primeRate');
			const annualRate = parseFloat(annualRateEl ? annualRateEl.value : 5.5) || 5.5;
			const primeRate = parseFloat(primeRateEl ? primeRateEl.value : 1.75) || 1.75;
			const totalRate = (annualRate + primeRate) / 100;
			const monthlyRate = totalRate / 12;

			if (monthlyRate === 0) {
				return payment * months;
			}

			const principal = payment * (Math.pow(1 + monthlyRate, months) - 1) / (monthlyRate * Math.pow(1 + monthlyRate, months));

			return principal;
		}

		function formatCurrency(amount) {
			return Math.round(amount).toLocaleString('he-IL') + ' ₪';
		}

		// Calculate values based on current mode
		let loanAmount, monthlyPayment, totalPayment, totalInterest;

		if (mode === 'amount') {
			loanAmount = state.loanAmount;
			monthlyPayment = calculateMonthlyPayment(loanAmount, state.numPayments);
		} else {
			monthlyPayment = state.monthlyPayment;
			loanAmount = calculateLoanAmount(monthlyPayment, state.numPayments);
		}

		totalPayment = monthlyPayment * state.numPayments;
		totalInterest = totalPayment - loanAmount;

		// Update modal display
		setTimeout(function () {
			const loanAmountDisplay = document.getElementById('modal-loan-amount-display');
			const monthlyPaymentDisplay = document.getElementById('modal-monthly-payment-display');
			const termDisplay = document.getElementById('modal-term-display');

			if (loanAmountDisplay) loanAmountDisplay.textContent = formatCurrency(loanAmount);
			if (monthlyPaymentDisplay) monthlyPaymentDisplay.textContent = formatCurrency(monthlyPayment);
			if (termDisplay) termDisplay.textContent = state.numPayments + ' חודשים';

			// Update hidden fields if they exist
			const loanAmountInput = document.querySelector('input[name="modal_loan_amount"]');
			const loanTermInput = document.querySelector('input[name="modal_loan_term"]');
			const monthlyPaymentInput = document.querySelector('input[name="modal_monthly_payment"]');
			const totalPaymentInput = document.querySelector('input[name="modal_total_payment"]');

			if (loanAmountInput) loanAmountInput.value = Math.round(loanAmount);
			if (loanTermInput) loanTermInput.value = state.numPayments;
			if (monthlyPaymentInput) monthlyPaymentInput.value = Math.round(monthlyPayment);
			if (totalPaymentInput) totalPaymentInput.value = Math.round(totalPayment);
		}, 100);
	});

	init();

	// Expose state for modal integration
	window.loanCalculatorState = state;
}