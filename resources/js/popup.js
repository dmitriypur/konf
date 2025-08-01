// Глобальные переменные
let modal = null;
let modalContent = null;
let modalClose = null;

// Инициализация модальных окон
function initModals() {
    modal = document.getElementById('modal');
    modalContent = document.getElementById('modal-content');
    modalClose = document.getElementById('modal-close');

    if (!modal || !modalContent || !modalClose) {
        console.warn('Modal elements not found');
        return;
    }





    // Делегирование событий для кнопок открытия
    document.addEventListener('click', function(e) {
        const button = e.target.closest('.open-modal-btn');
        if (!button) return;

        const targetId = button.dataset.modalTarget;
        const price = button.dataset.price;
        const tariff = button.dataset.tariff;
        if (!targetId) return;

        openModal(targetId, tariff, price);
    });

    // Закрытие по кнопке
    modalClose.addEventListener('click', closeModal);

    // Закрытие по клику вне окна
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });

    // Закрытие по Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
    });
}

// Открытие модального окна
function openModal(targetId, tariff, price) {
    const template = document.getElementById(targetId);
    const inputTariff = template.content.querySelector('form > input[name="tariff_id"]');
    const inputPrice = template.content.querySelector('form > input[name="price"]');
    if(inputTariff){
        inputTariff.value = tariff;
    }
    if(inputPrice){
        inputPrice.value = price;
    }
    if (!template) {
        console.warn('Modal template not found:', targetId);
        return;
    }

    // Очищаем контент перед вставкой
    modalContent.innerHTML = '';
    modalContent.appendChild(template.content.cloneNode(true));
    modal.classList.remove('hidden');

    // Динамический src для видео
    if (targetId === 'video') {
        // Найти кнопку, вызвавшую модалку
        const lastActiveBtn = document.activeElement;
        let videoSrc = '';
        if (lastActiveBtn && lastActiveBtn.classList.contains('open-modal-btn')) {
            videoSrc = lastActiveBtn.getAttribute('data-video') || '';
        }
        // fallback: ищем последнюю кликнутую .open-modal-btn
        if (!videoSrc) {
            const btn = document.querySelector('.open-modal-btn[data-modal-target="video"]:focus') || document.querySelector('.open-modal-btn[data-modal-target="video"]');
            if (btn) videoSrc = btn.getAttribute('data-video') || '';
        }
        // Подставить src
        const video = modalContent.querySelector('#html5Video');
        const source = video ? video.querySelector('source') : null;
        if (source) {
            source.src = videoSrc;
            video.load();
        }
    }

    // Инициализируем компоненты внутри модального окна
    initModalComponents();
}

// Закрытие модального окна
function closeModal() {
    // Очищаем src у видео, если есть
    const video = modalContent.querySelector('#html5Video');
    if (video) {
        const source = video.querySelector('source');
        if (source) source.src = '';
        video.load();
    }
    modal.classList.add('hidden');
    modalContent.innerHTML = '';
}

// Инициализация компонентов внутри модального окна
function initModalComponents() {
    // Инициализация маски телефона
    initPhoneMask();

    // Инициализация валидации полей
    initFormValidation();
}

// Инициализация маски телефона
function initPhoneMask() {
    const phoneInput = document.querySelector('.phone-input');
    if (!phoneInput) return;

    phoneInput.addEventListener('input', function(e) {
        let value = phoneInput.value.replace(/\D/g, '').substring(1);
        let formatted = '+7';

        if (value.length > 0) formatted += ' (' + value.substring(0, 3);
        if (value.length >= 3) formatted += ') ' + value.substring(3, 6);
        if (value.length >= 6) formatted += '-' + value.substring(6, 8);
        if (value.length >= 8) formatted += '-' + value.substring(8, 10);

        phoneInput.value = formatted;
    });
}

// Инициализация валидации формы
function initFormValidation() {
    const form = document.querySelector('form');
    if (!form) return;

    const requiredFields = form.querySelectorAll('[data-required]');
    if (requiredFields.length === 0) return;

    requiredFields.forEach(function(input) {
        input.addEventListener('input', function(e) {
            validateField(e.target);
        });

        input.addEventListener('blur', function(e) {
            validateField(e.target);
        });
    });
}

// Валидация отдельного поля
function validateField(input) {
    const parent = input.parentNode;
    if (!parent) return;

    const isValid = input.value.trim().length >= 2;

    if (isValid) {
        parent.classList.add('before:bg-green-600');
        parent.classList.remove('before:bg-red-600', 'before:bg-linear-(--white2-gr)', 'before:bg-linear-(--violet-gr)');
    } else {
        parent.classList.add('before:bg-red-600');
        parent.classList.remove('before:bg-green-600', 'before:bg-linear-(--white2-gr)', 'before:bg-linear-(--violet-gr)');
    }

    if (input.name === 'agree') {
        if (!input.checked) {
            parent.classList.add('bg-red-400', 'p-2', 'rounded-xl');
        } else {
            parent.classList.remove('bg-red-400', 'p-2', 'rounded-xl');
        }

    }
}



// Инициализация при загрузке DOM
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initModals);
} else {
    initModals();
}
