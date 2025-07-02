// Делегирование событий для обработки динамических форм
document.addEventListener('submit', function (e) {
    if (!e.target.classList.contains('bitrix-form')) return;
    e.preventDefault();
    handleBitrixFormSubmit(e.target);
});

/**
 * Основная функция обработки отправки формы
 */
function handleBitrixFormSubmit(form) {
    if (!validateBitrixForm(form)) return;

    const formData = prepareBitrixFormData(form);
    sendBitrixFormData(form, formData);
}

/**
 * Валидация формы
 */
function validateBitrixForm(form) {
    const requiredFields = form.querySelectorAll('[data-required]');
    let isValid = true;

    requiredFields.forEach(input => {
        if (!input.value.trim()) {
            isValid = false;
            markFieldAsInvalid(input);
        }
    });

    if (!isValid) {
        showBitrixAlert(form, 'Пожалуйста, заполните обязательные поля', 'error');
    }

    return isValid;
}

/**
 * Подготовка данных формы
 */
function prepareBitrixFormData(form) {
    const formData = new FormData(form);
    formData.append('form_type', form.dataset.form || 'default');
    formData.append('form_name', form.dataset.name || 'unnamed');
    return formData;
}

/**
 * Отправка данных формы
 */
function sendBitrixFormData(form, formData) {
    const loader = form.querySelector('.form-loader');
    toggleBitrixLoader(loader, true);

    fetch('/deals', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken()
        },
        body: formData
    })
        .then(response => handleBitrixResponse(form, loader, response))
        .catch(error => handleBitrixError(form, loader, error));
}

/**
 * Обработка ответа сервера
 */
function handleBitrixResponse(form, loader, response) {
    return response.json()
        .then(data => {
            if (data.success) {
                showBitrixAlert(form, 'Заявка успешно отправлена!', 'success');
                form.reset();

                // Закрытие модального окна после успешной отправки (если нужно)
                const modal = form.closest('.modal');
                if (modal) setTimeout(() => modal.style.display = 'none', 2000);
            } else {
                showBitrixAlert(form, data.message || 'Ошибка отправки. Попробуйте позже.', 'error');
            }
        })
        .finally(() => toggleBitrixLoader(loader, false));
}

/**
 * Обработка ошибок
 */
function handleBitrixError(form, loader, error) {
    showBitrixAlert(form, 'Ошибка сети. Повторите попытку.', 'error');
    console.error('Form submission error:', error);
    toggleBitrixLoader(loader, false);
}

/**
 * Вспомогательные функции
 */
function toggleBitrixLoader(loader, show) {
    if (!loader) return;
    loader.classList.toggle('hidden', !show);
}

function showBitrixAlert(form, message, type) {
    const alertBox = form.querySelector('.form-alert');
    if (!alertBox) return;

    alertBox.textContent = message;
    alertBox.className = `form-alert text-xs text-center text-white p-2 rounded-xl ${type === 'success' ? 'bg-green-600' : 'bg-red-400'}`;
    alertBox.classList.remove('hidden');
}

function markFieldAsInvalid(field) {
    field.classList.add('border-red-500');
    const parent = field.parentNode;
    if (parent) {
        parent.classList.add('before:bg-red-600');
        parent.classList.remove('before:bg-linear-(--white2-gr)', 'before:bg-linear-(--violet-gr)');
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]')?.content || '';
}
