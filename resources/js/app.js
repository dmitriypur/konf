import './bootstrap';
import { Navigation } from "swiper/modules";
import 'swiper/css';
import 'swiper/css/navigation';
import './popup';
import './timer';
import './dinamic-adapt';
import './bitrix-form';
import LazyLoad from "vanilla-lazyload";

// Глобальные переменные
let lazyMedia = null;
let swiperInstances = new Map();

// Инициализация LazyLoad с оптимизацией
function initLazyLoad() {
    if (!lazyMedia) {
        lazyMedia = new LazyLoad({
            elements_selector: '[data-src]:not([fetchpriority="high"])',
            class_loaded: '_lazy-loaded',
            use_native: true,
            callback_loaded: (img) => {
                img.classList.add('loaded');
            },
            callback_error: (img) => {
                console.warn('Failed to load image:', img.dataset.src);
            }
        });
    }
    return lazyMedia;
}

// Ленивая загрузка Swiper с кэшированием
const loadSwiper = async () => {
    if (window.Swiper) return window.Swiper;
    const { default: Swiper } = await import('swiper/bundle');
    window.Swiper = Swiper;
    return Swiper;
};

// Оптимизированная функция плавного скролла
function smoothScrollTo(target) {
    if (!target) return;

    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    const duration = Math.min(Math.abs(distance) * 0.3, 600); // Уменьшил длительность
    let startTime = null;

    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = easeInOutQuad(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) {
            requestAnimationFrame(animation);
        }
    }

    function easeInOutQuad(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }

    requestAnimationFrame(animation);
}

// Инициализация плавного скролла
function initSmoothScroll() {
    document.addEventListener('click', function(e) {
        const anchor = e.target.closest('a[href^="#"]');
        if (!anchor) return;

        const targetId = anchor.getAttribute('href');
        if (targetId === '#' || targetId === '#!') return;

        e.preventDefault();

        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            smoothScrollTo(targetElement);
        }
    });
}

// Оптимизированная инициализация Swiper слайдеров с отложенной загрузкой
function initSwipers(Swiper) {
    const swiperConfigs = [
        {
            selector: '.speakers',
            config: {
                modules: [Navigation],
                spaceBetween: 95,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.speakers-button-next',
                    prevEl: '.speakers-button-prev',
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 1 },
                    1024: { slidesPerView: 2 },
                }
            }
        },
        {
            selector: '.reviews',
            config: {
                modules: [Navigation],
                spaceBetween: 10,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.reviews-button-next',
                    prevEl: '.reviews-button-prev',
                }
            }
        },
        {
            selector: '.gallery',
            config: {
                modules: [Navigation],
                spaceBetween: 10,
                slidesPerView: 1,
                navigation: {
                    nextEl: '.gallery-button-next',
                    prevEl: '.gallery-button-prev',
                }
            }
        },
        {
            selector: '.themes',
            config: {
                modules: [Navigation],
                spaceBetween: 20,
                slidesPerView: 4,
                navigation: {
                    nextEl: '.themes-button-next',
                    prevEl: '.themes-button-prev',
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 4 },
                }
            }
        },
        {
            selector: '.programm',
            config: {
                modules: [Navigation],
                spaceBetween: 20,
                slidesPerView: 6,
                navigation: {
                    nextEl: '.programm-button-next',
                    prevEl: '.programm-button-prev',
                },
                breakpoints: {
                    0: { slidesPerView: 1 },
                    768: { slidesPerView: 3 },
                    1024: { slidesPerView: 6 },
                }
            }
        }
    ];

    // Инициализируем слайдеры с задержкой для избежания layout thrashing
    swiperConfigs.forEach(({ selector, config }, index) => {
        const element = document.querySelector(selector);
        if (!element) return;

        // Отложенная инициализация для каждого слайдера
        setTimeout(() => {
            const slidesCount = element.querySelectorAll('.swiper-slide').length;
            const minSlides = config.slidesPerView || 1;

            // Проверяем количество слайдов для loop с учетом breakpoints
            let maxSlidesPerView = minSlides;
            if (config.breakpoints) {
                maxSlidesPerView = Math.max(...Object.values(config.breakpoints).map(bp => bp.slidesPerView || minSlides));
            }

            // Включаем loop только если слайдов больше чем максимальное количество на экране
            config.loop = slidesCount > maxSlidesPerView;

            const swiper = new Swiper(selector, config);
            swiperInstances.set(selector, swiper);
        }, index * 50); // 50ms задержка между инициализацией слайдеров
    });

    // Специальная обработка для partners слайдера
    initPartnersSwiper(Swiper);
}

// Инициализация partners слайдера с адаптивностью
function initPartnersSwiper(Swiper) {
    const swiperElement = document.querySelector('.partners');
    if (!swiperElement) return;

    const mediaQuery = window.matchMedia('(min-width: 1024px)');
    let swiperInstance = null;

    function enableSwiper() {
        if (swiperInstance) return;

        // Отложенная инициализация
        setTimeout(() => {
            const slidesCount = swiperElement.querySelectorAll('.swiper-slide').length;
            swiperInstance = new Swiper(swiperElement, {
                modules: [Navigation],
                loop: slidesCount > 3,
                spaceBetween: 90,
                slidesPerView: 3,
                navigation: {
                    nextEl: '.partners-button-next',
                    prevEl: '.partners-button-prev',
                },
            });
            swiperInstances.set('.partners', swiperInstance);
        }, 100);
    }

    function disableSwiper() {
        if (swiperInstance) {
            swiperInstance.destroy(true, true);
            swiperInstance = null;
            swiperInstances.delete('.partners');
        }
    }

    function checkSwiperActivation(e) {
        if (e.matches) {
            enableSwiper();
        } else {
            disableSwiper();
        }
    }

    checkSwiperActivation(mediaQuery);
    mediaQuery.addEventListener('change', checkSwiperActivation);
}

// Инициализация табов
function initTabs() {
    const buttons = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    if (buttons.length === 0) return;

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');
            if (!tabId) return;

            // Убираем active классы
            buttons.forEach(btn => {
                btn.classList.remove('text-white');
                btn.classList.add('text-white/60');
            });
            contents.forEach(content => content.classList.add('hidden'));

            // Добавляем active классы
            button.classList.add('text-white');
            button.classList.remove('text-white/60');

            const targetContent = document.getElementById(tabId);
            if (targetContent) {
                targetContent.classList.remove('hidden');
            }
        });
    });
}

// Инициализация мобильного меню
function initMobileMenu() {
    const hamburger = document.getElementById('hamburger');
    if (!hamburger) return;

    hamburger.addEventListener('click', () => {
        const pinkCircle = document.getElementById('pink-circle');
        const mobileMenu = document.getElementById('mobile-menu');

        if (pinkCircle) pinkCircle.classList.toggle('opacity-60');
        if (mobileMenu) mobileMenu.classList.toggle('max-h-80');
    });
}

// Инициализация формы добавления пользователей
function initUserForm() {
    let userCount = 0;

    document.addEventListener('click', function(e) {
        if (!e.target.classList.contains('add-user')) return;

        userCount++;
        const blocks = document.querySelectorAll('.user-data');
        if (blocks.length === 0) return;

        const clone = blocks[blocks.length - 1].cloneNode(true);
        const inputs = clone.querySelectorAll('input, textarea, select');

        inputs.forEach(el => {
            el.name = el.name.replace(/[0-9]/g, userCount);
            el.value = '';
            if (el.parentNode.classList.contains('phone')) {
                el.parentNode.remove();
            }
        });

        clone.insertAdjacentHTML('afterbegin', `<p class="user-num text-sm mb-2">Участник №${userCount + 1}</p>`);

        const userNums = clone.querySelectorAll('.user-num');
        if (userNums.length > 1) {
            userNums[1].remove();
        }

        blocks[blocks.length - 1].after(clone);
    });
}

// Инициализация следящего элемента
function initFollower() {
    const follower = document.getElementById('follower');
    if (!follower || !window.matchMedia('(min-width: 1024px)').matches) return;

    let currentX = 0, currentY = 0;
    let mouseX = 0, mouseY = 0;
    const speed = 0.05;
    const width = 320;
    const height = 320;

    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX - width / 2;
        mouseY = e.clientY - height / 2;
    });

    function animate() {
        currentX += (mouseX - currentX) * speed;
        currentY += (mouseY - currentY) * speed;
        follower.style.transform = `translate(${currentX}px, ${currentY}px)`;
        requestAnimationFrame(animate);
    }

    animate();
}

// Основная инициализация
function initApp() {
    // Инициализируем компоненты сразу
    initSmoothScroll();
    initTabs();
    initMobileMenu();
    initUserForm();
    initFollower();

    // Инициализируем LazyLoad
    initLazyLoad();
}

// Запускаем инициализацию
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initApp);
} else {
    initApp();
}

// Оптимизированная инициализация Swiper с использованием requestIdleCallback
function initSwipersWhenIdle() {
    if ('requestIdleCallback' in window) {
        requestIdleCallback(async () => {
            try {
                const Swiper = await loadSwiper();
                initSwipers(Swiper);

                // Обновляем LazyLoad после инициализации слайдеров
                if (lazyMedia) {
                    lazyMedia.update();
                    setTimeout(() => lazyMedia.update(), 100);
                }
            } catch (error) {
                console.error('Failed to initialize Swiper:', error);
            }
        }, { timeout: 2000 });
    } else {
        // Fallback для браузеров без requestIdleCallback
        setTimeout(async () => {
            try {
                const Swiper = await loadSwiper();
                initSwipers(Swiper);

                if (lazyMedia) {
                    lazyMedia.update();
                    setTimeout(() => lazyMedia.update(), 100);
                }
            } catch (error) {
                console.error('Failed to initialize Swiper:', error);
            }
        }, 100);
    }
}

// Инициализация Swiper после загрузки с оптимизацией
document.addEventListener('DOMContentLoaded', initSwipersWhenIdle);

// Очистка при размонтировании
window.addEventListener('beforeunload', () => {
    swiperInstances.forEach(swiper => {
        if (swiper && typeof swiper.destroy === 'function') {
            swiper.destroy(true, true);
        }
    });
    swiperInstances.clear();
});
