// Wizard State
let wizardState = {
    currentStep: 1,
    slideDirection: 'left',
    isSubmitted: false,
    isInitialRender: true,
    formData: {
        loanPurpose: null,
        loanAmount: null,
        name: '',
        phone: '',
        consent: false
    }
};

let wizardAutoShown = false;

function tryAutoOpenWizard() {
    if (wizardAutoShown) return;
    wizardAutoShown = true;
    openWizard();
}

// Step Data (from ACF Options via ucreditWizard, fallback if not set)
const step1Options = (typeof ucreditWizard !== 'undefined' && Array.isArray(ucreditWizard.step1_options))
    ? ucreditWizard.step1_options
    : [
        { value: 'minus', label: 'סגירת מינוס / הוצאות שוטפות' },
        { value: 'business', label: 'הקמת או חיזוק עסק' },
        { value: 'vehicle', label: 'רכב / ציוד / כלי עבודה' },
        { value: 'event', label: 'אירוע, לימודים או חופשה' },
        { value: 'investment', label: 'השקעה או שדרוג נכס' },
        { value: 'other', label: 'משהו אחר' }
    ];

const step2Options = (typeof ucreditWizard !== 'undefined' && Array.isArray(ucreditWizard.step2_options))
    ? ucreditWizard.step2_options
    : [
        { value: 'up20', label: 'עד 20 אלף ש"ח' },
        { value: 'up50', label: 'עד 50 אלף ש"ח' },
        { value: 'between50-100', label: 'בין 50 ל-100 אלף ש"ח' },
        { value: 'up250', label: 'עד 250 אלף ש"ח' },
        { value: 'unsure', label: 'עדיין לא בטוח / רוצה ייעוץ' }
    ];

function getWizardStr(key, fallback) {
    const raw = (typeof ucreditWizard !== 'undefined' && ucreditWizard[key]) ? ucreditWizard[key] : fallback;
    return typeof raw === 'string' ? escapeWizardHtml(raw) : raw;
}
function escapeWizardHtml(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// Open Wizard
function openWizard() {
    const overlay = document.getElementById('wizardOverlay');
    overlay.classList.add('active');
    wizardState.isInitialRender = true;
    renderStep();
}

// Close Wizard
function closeWizard() {
    const overlay = document.getElementById('wizardOverlay');
    overlay.classList.remove('active');

    // Reset state after animation
    setTimeout(() => {
        const content = document.getElementById('wizardContent');
        if (content) {
            content.innerHTML = '';
        }

        wizardState = {
            currentStep: 1,
            slideDirection: 'left',
            isSubmitted: false,
            isInitialRender: true,
            formData: {
                loanPurpose: null,
                loanAmount: null,
                name: '',
                phone: '',
                consent: false
            }
        };
    }, 300);
}

// Handle overlay click
function handleOverlayClick(event) {
    if (event.target.id === 'wizardOverlay') {
        closeWizard();
    }
}

// Navigation
function goNext() {
    wizardState.slideDirection = 'left';
    wizardState.currentStep = Math.min(wizardState.currentStep + 1, 3);
    renderStep();
}

function goBack() {
    wizardState.slideDirection = 'right';
    wizardState.currentStep = Math.max(wizardState.currentStep - 1, 1);
    renderStep();
}

// Step 1 Selection
function selectStep1Option(value) {
    wizardState.formData.loanPurpose = value;
    // Update UI without re-rendering full step
    const buttons = document.querySelectorAll('.option-btn');
    buttons.forEach(btn => {
        if (btn.getAttribute('onclick') === `selectStep1Option('${value}')`) {
            btn.classList.add('selected');
        } else {
            btn.classList.remove('selected');
        }
    });

    // Auto-advance after a short delay
    setTimeout(() => {
        goNext();
    }, 400);
}

// Step 2 Selection
function selectStep2Option(value) {
    wizardState.formData.loanAmount = value;
    // Update UI without re-rendering full step
    const buttons = document.querySelectorAll('.option-btn');
    buttons.forEach(btn => {
        if (btn.getAttribute('onclick') === `selectStep2Option('${value}')`) {
            btn.classList.add('selected');
        } else {
            btn.classList.remove('selected');
        }
    });

    // Auto-advance after a short delay
    setTimeout(() => {
        goNext();
    }, 400);
}

// Form Input Handlers
function updateName(value) {
    wizardState.formData.name = value;
    updateSubmitButton();
}

function updatePhone(inputOrValue) {
    const el = typeof inputOrValue === 'object' && inputOrValue && 'value' in inputOrValue ? inputOrValue : null;
    let value = el ? el.value : String(inputOrValue);
    value = value.replace(/\D/g, '').slice(0, 10);
    wizardState.formData.phone = value;
    if (el) {
        el.value = value;
    }
    updateSubmitButton();
}

function updateConsent(checked) {
    wizardState.formData.consent = checked;
    updateSubmitButton();
}

// Update Submit Button State
function updateSubmitButton() {
    const submitBtn = document.getElementById('submitButton');
    const phoneDigits = wizardState.formData.phone.replace(/\D/g, '');
    const isValid = wizardState.formData.name.trim() !== '' &&
                   phoneDigits.length === 10 &&
                   wizardState.formData.consent;

    submitBtn.disabled = !isValid;
}

// Submit Form
function submitForm() {
    const submitBtn = document.getElementById('submitButton');
    const successOverlay = document.getElementById('successOverlay');

    if (typeof ucreditWizard === 'undefined' || !ucreditWizard.ajax_url || !ucreditWizard.nonce) {
        showWizardSuccess(successOverlay);
        return;
    }

    submitBtn.disabled = true;

    const formData = new FormData();
    formData.append('action', 'ucredit_wizard_submit');
    formData.append('nonce', ucreditWizard.nonce);
    formData.append('name', wizardState.formData.name.trim());
    formData.append('phone', wizardState.formData.phone.trim());
    formData.append('loan_purpose', wizardState.formData.loanPurpose || '');
    formData.append('loan_amount', wizardState.formData.loanAmount || '');
    formData.append('consent', wizardState.formData.consent ? '1' : '0');

    fetch(ucreditWizard.ajax_url, {
        method: 'POST',
        body: formData,
        credentials: 'same-origin',
    })
        .then(function (response) {
            return response.json();
        })
        .then(function (data) {
            if (data.success) {
                if (data.data && data.data.crm_response) {
                    console.log('CRM response:', data.data.crm_response);
                }
                showWizardSuccess(successOverlay);
            } else {
                if (data.data && data.data.crm_response) {
                    console.log('CRM response (error):', data.data.crm_response);
                }
                alert(data.data && data.data.message ? data.data.message : 'An error occurred. Please try again.');
                submitBtn.disabled = false;
            }
        })
        .catch(function () {
            alert('Request failed. Please try again.');
            submitBtn.disabled = false;
        });
}

function showWizardSuccess(successOverlay) {
    if (!successOverlay) return;
    successOverlay.classList.remove('hidden');
    successOverlay.classList.add('active');
    setTimeout(function () {
        closeWizard();
        successOverlay.classList.remove('active');
        setTimeout(function () {
            successOverlay.classList.add('hidden');
        }, 300);
    }, 3000);
}

// Render Step Content
function renderStep() {
    const content = document.getElementById('wizardContent');
    const backButton = document.getElementById('backButton');
    const submitButton = document.getElementById('submitButton');

    // Update progress bar
    updateProgressBar();

    // Show/hide back button
    if (wizardState.currentStep > 1 && !wizardState.isSubmitted) {
        backButton.classList.remove('hidden');
    } else {
        backButton.classList.add('hidden');
    }

    // Show/hide submit button
    if (wizardState.currentStep === 3) {
        submitButton.classList.remove('hidden');
        updateSubmitButton();
    } else {
        submitButton.classList.add('hidden');
    }

    // Get step HTML
    let stepHTML = '';
    if (wizardState.currentStep === 1) {
        stepHTML = renderStep1();
    } else if (wizardState.currentStep === 2) {
        stepHTML = renderStep2();
    } else if (wizardState.currentStep === 3) {
        stepHTML = renderStep3();
    }

    // Get existing step element
    const existingStep = content.querySelector('.wizard-step');

    // Determine animation classes
    const enterClass = wizardState.slideDirection === 'left' ? 'slide-left-enter' : 'slide-right-enter';
    const exitClass = wizardState.slideDirection === 'left' ? 'slide-left-exit' : 'slide-right-exit';

    // If there's an existing step, animate it out first
    if (existingStep) {
        // Remove active class and add exit animation
        existingStep.classList.remove('active');
        existingStep.classList.add(exitClass);

        // Wait for exit animation, then create new step
        setTimeout(() => {
            createNewStep(content, stepHTML, enterClass);
        }, 50); // Small delay to ensure exit animation starts
    } else {
        // No existing step, create immediately
        createNewStep(content, stepHTML, enterClass);
    }
}

// Helper function to create new step with proper animation
function createNewStep(container, html, enterClass) {
    // Create new step element
    const newStep = document.createElement('div');

    // Check if this is initial render before modifying the flag
    const isInitial = wizardState.isInitialRender;

    // On initial render, don't apply animation
    if (isInitial) {
        newStep.className = 'wizard-step active';
        wizardState.isInitialRender = false;
    } else {
        newStep.className = `wizard-step ${enterClass}`;
    }

    newStep.innerHTML = html;

    // Insert into container
    container.innerHTML = '';
    container.appendChild(newStep);

    // If not initial render, animate in
    if (!isInitial) {
        // Force reflow to ensure initial state is applied
        void newStep.offsetHeight;

        // Add active class and remove enter class in next frame for smooth animation
        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                newStep.classList.add('active');
                newStep.classList.remove(enterClass);
            });
        });
    }
}

// Update Progress Bar
function updateProgressBar() {
    const steps = document.querySelectorAll('.progress-step');
    steps.forEach((step, index) => {
        if (index < wizardState.currentStep) {
            step.classList.add('active');
        } else {
            step.classList.remove('active');
        }
    });
}

// Render Step 1
function renderStep1() {
    const options = step1Options.map(option => `
        <button
            class="option-btn ${wizardState.formData.loanPurpose === option.value ? 'selected' : ''}"
            onclick="selectStep1Option('${escapeWizardHtml(option.value)}')"
        >
            ${escapeWizardHtml(option.label)}
        </button>
    `).join('');

    const title = getWizardStr('step1_title', 'עבור מה אתם צריכים הלוואה?');
    const subtitle = getWizardStr('step1_subtitle', 'עוזר לנו להתאים את ההצעה – לא מחייב');
    return `
        <h2 class="step-title">${title}</h2>
        <p class="step-subtitle">${subtitle}</p>
        <div class="option-list">
            ${options}
        </div>
    `;
}

// Render Step 2
function renderStep2() {
    const options = step2Options.map(option => `
        <button
            class="option-btn ${wizardState.formData.loanAmount === option.value ? 'selected' : ''}"
            onclick="selectStep2Option('${escapeWizardHtml(option.value)}')"
        >
            ${escapeWizardHtml(option.label)}
        </button>
    `).join('');

    const title = getWizardStr('step2_title', 'איזה סדר גודל של סכום רלוונטי לכם?');
    const subtitle = getWizardStr('step2_subtitle', 'אפשר לשנות את הסכום בהמשך');
    return `
        <h2 class="step-title">${title}</h2>
        <p class="step-subtitle">${subtitle}</p>
        <div class="option-list">
            ${options}
        </div>
    `;
}

// Render Step 3
function renderStep3() {
    const title = getWizardStr('step3_title', 'מצאנו כיוון שמתאים לכם');
    const subtitle = getWizardStr('step3_subtitle', 'השאירו פרטים ונחזור אליכם עם הצעה מותאמת');
    const placeholderName = getWizardStr('placeholder_name', 'שם מלא');
    const placeholderPhone = getWizardStr('placeholder_phone', 'טלפון ליצירת קשר (ללא התחייבות)');
    const trust1 = getWizardStr('trust_1', 'פרטים נשמרים בדיסקרטיות מלאה');
    const trust2 = getWizardStr('trust_2', 'חזרה מהירה');
    const trust3 = getWizardStr('trust_3', 'ללא התחייבות');
    const consentText = getWizardStr('consent_text', 'אני מאשר/ת יצירת קשר בהתאם לתנאי השימוש ומדיניות הפרטיות');
    return `
        <h2 class="step-title">${title}</h2>
        <p class="step-subtitle">${subtitle}</p>

        <div class="form-group">
            <input
                type="text"
                class="form-input"
                placeholder="${placeholderName}"
                value="${wizardState.formData.name}"
                oninput="updateName(this.value)"
            />
            <input
                type="tel"
                class="form-input"
                placeholder="${placeholderPhone}"
                value="${wizardState.formData.phone}"
                inputmode="numeric"
                pattern="[0-9]*"
                maxlength="10"
                oninput="updatePhone(this)"
            />
        </div>

        <div class="trust-box">
            <div class="trust-item">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
                <span>${trust1}</span>
            </div>
            <div class="trust-item">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
                <span>${trust2}</span>
            </div>
            <div class="trust-item">
                <svg class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>${trust3}</span>
            </div>
        </div>

        <label class="consent-label">
            <input
                type="checkbox"
                class="consent-checkbox"
                ${wizardState.formData.consent ? 'checked' : ''}
                onchange="updateConsent(this.checked)"
            />
            <span class="consent-text">
                ${consentText}
            </span>
        </label>
    `;
}

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => {
    renderStep();

    // Auto-show after 15 seconds (once per load)
    setTimeout(tryAutoOpenWizard, 15000);

    // Exit intent: show when mouse leaves toward top (desktop only)
    if (window.innerWidth >= 768) {
        document.addEventListener('mouseout', function (e) {
            if (e.clientY <= 5) {
                tryAutoOpenWizard();
            }
        });
    }
});
