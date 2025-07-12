import './bootstrap';
import Swiper from 'swiper/bundle';
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import {Navigation} from "swiper/modules";
import './popup';
import './timer';
import './dinamic-adapt';
import './bitrix-form';
import LazyLoad from "vanilla-lazyload";

// Работает с объектами с класом ._lazy
const lazyMedia = new LazyLoad({
    elements_selector: '[data-src],[data-srcset]',
    class_loaded: '_lazy-loaded',
    use_native: true
});

// Плавный скролл
document.addEventListener('DOMContentLoaded', function() {
    // 1. Плавный скролл по якорным ссылкам
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            const targetId = this.getAttribute('href');

            // Проверяем, что это именно якорная ссылка (начинается с # и не просто #)
            if (targetId === '#' || targetId === '#!') {
                return; // Прерываем выполнение для ссылок вида href="#"
            }

            e.preventDefault();
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                smoothScrollTo(targetElement);
            }
        });
    });

    // 3. Функция плавного скролла
    function smoothScrollTo(target) {
        const targetPosition = target.getBoundingClientRect().top + window.pageYOffset;
        const startPosition = window.pageYOffset;
        const distance = targetPosition - startPosition;
        const duration = 800; // Длительность анимации в ms
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

        // Функция для плавного ускорения и замедления
        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return c / 2 * t * t + b;
            t--;
            return -c / 2 * (t * (t - 2) - 1) + b;
        }

        requestAnimationFrame(animation);
    }
});


// Слайдеры
document.addEventListener('DOMContentLoaded', () => {
    if(document.querySelector('.speakers')){
        Swiper.use([Navigation]);
        const swiper = new Swiper('.speakers', {
            loop: true,
            spaceBetween: 20,
            slidesPerView: 1,
            navigation: {
                nextEl: '.speakers-button-next',
                prevEl: '.speakers-button-prev',
            },
        });
    }

    let swiperInstance = null;

    const swiperElement = document.querySelector('.partners');
    const mediaQuery = window.matchMedia('(min-width: 1024px)');

    function enableSwiper() {
        // Swiper.use([Navigation]);
        swiperInstance = new Swiper(swiperElement, {
            modules: [Navigation],
            loop: true,
            spaceBetween: 90,
            slidesPerView: 3,
            navigation: {
                nextEl: '.partners-button-next',
                prevEl: '.partners-button-prev',
            },
        });
    }
    function disableSwiper() {
        if (swiperInstance) {
            swiperInstance.destroy(true, true);
            swiperInstance = null;
        }
    }

    function checkSwiperActivation(e) {
        if (e.matches) {
            if (!swiperInstance) {
                enableSwiper();
            }
        } else {
            disableSwiper();
        }
    }

    // При первом запуске
    checkSwiperActivation(mediaQuery);

    // При изменении ширины
    mediaQuery.addEventListener('change', checkSwiperActivation);

    // if (window.matchMedia('(min-width: 768px)').matches) {
    //     if (document.querySelector('.partners')) {
    //         Swiper.use([Navigation]);
    //         const swiper = new Swiper('.partners', {
    //             loop: true,
    //             spaceBetween: 90,
    //             slidesPerView: 3,
    //             navigation: {
    //                 nextEl: '.partners-button-next',
    //                 prevEl: '.partners-button-prev',
    //             },
    //         });
    //     }
    // }


    if(document.querySelector('.reviews')){
        Swiper.use([Navigation]);
        const swiper = new Swiper('.reviews', {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: '.reviews-button-next',
                prevEl: '.reviews-button-prev',
            },
        });
    }

    if(document.querySelector('.gallery')){
        Swiper.use([Navigation]);
        const swiper = new Swiper('.gallery', {
            loop: true,
            spaceBetween: 10,
            slidesPerView: 1,
            navigation: {
                nextEl: '.gallery-button-next',
                prevEl: '.gallery-button-prev',
            },
        });
    }

    if(document.querySelector('.themes')){
        Swiper.use([Navigation]);
        const swiper = new Swiper('.themes', {
            loop: true,
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
        });
    }
    if(document.querySelector('.programm')){
        Swiper.use([Navigation]);
        const swiper = new Swiper('.programm', {
            loop: true,
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
        });
    }
});

// Табы
document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.tab-button');
    const contents = document.querySelectorAll('.tab-content');

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const tabId = button.getAttribute('data-tab');

            // Убираем active классы и скрываем контент
            buttons.forEach(btn => {
                btn.classList.remove('text-white')
                btn.classList.add('text-white/60')
            });
            contents.forEach(content => content.classList.add('hidden'));

            // Добавляем active классы и показываем нужный контент
            button.classList.add('text-white');
            button.classList.remove('text-white/60');
            document.getElementById(tabId).classList.remove('hidden');
        });
    });
});


// Мобильное меню
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('hamburger').addEventListener('click', toggleMobileMenu)

    function toggleMobileMenu(){
        document.getElementById('pink-circle').classList.toggle('opacity-60')
        document.getElementById('mobile-menu').classList.toggle('max-h-80')
    }
});

// Добавление пользователя в форме
document.addEventListener('DOMContentLoaded', () => {
    let i = 0;
    document.addEventListener('click', function(e){
        if(e.target.classList.contains('add-user')){
            i++;
            // e.target.remove();
            let block = document.querySelectorAll('.user-data');
            let clone = block[block.length - 1].cloneNode(true);

            let inputs = clone.querySelectorAll('input, textarea, select');
            inputs.forEach(el => {
                el.name = el.name.replace(/[0-9]/g, i);
                el.value = '';
                if(el.parentNode.classList.contains('phone')){
                    el.parentNode.remove();
                }
                console.log(el.name)
                // el.name = el.name + i;
            });

            clone.insertAdjacentHTML('afterbegin', `<p class="user-num text-sm mb-2">Участник №${i+1}</p>`);
            if(clone.querySelectorAll('.user-num').length > 1){
                clone.querySelectorAll('.user-num')[1].remove();
            }

            block[block.length - 1].after(clone);
        }

    });


    var follower = document.getElementById('follower');
    var currentX = 0, currentY = 0;
    var mouseX = 0, mouseY = 0;
    var speed = 0.05;
    var width = 320;
    var height = 320;

    document.addEventListener('mousemove', function(e) {
        mouseX = e.clientX - width / 2;
        mouseY = e.clientY - height / 2;
    });

    function animate() {
        currentX += (mouseX - currentX) * speed;
        currentY += (mouseY - currentY) * speed;
        follower.style.transform = 'translate(' + currentX + 'px, ' + currentY + 'px)';
        requestAnimationFrame(animate);
    }

    if(window.matchMedia('(min-width: 1024px)').matches){
        animate();
    }

});
