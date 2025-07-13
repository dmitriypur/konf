// Глобальные переменные
let timerInterval = null;
let countdownElement = null;

// Инициализация таймера
function initTimer() {
    countdownElement = document.getElementById('countdown');
    if (!countdownElement) {
        console.warn('Countdown element not found');
        return;
    }

    const deadlineStr = countdownElement.dataset.deadline;
    if (!deadlineStr) {
        console.warn('Deadline not set');
        return;
    }

    const deadline = new Date(deadlineStr).getTime();
    if (isNaN(deadline)) {
        console.warn('Invalid deadline format');
        return;
    }

    // Очищаем предыдущий интервал
    if (timerInterval) {
        clearInterval(timerInterval);
    }

    // Запускаем таймер
    timerInterval = setInterval(() => updateTimer(deadline), 1000);
    
    // Первоначальное обновление
    updateTimer(deadline);
}

// Обновление таймера
function updateTimer(deadline) {
    const now = new Date().getTime();
    const timeLeft = deadline - now;

    if (timeLeft <= 0) {
        clearInterval(timerInterval);
        timerInterval = null;
        setTimerDisplay(0, 0, 0, 0);
        return;
    }

    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    setTimerDisplay(days, hours, minutes, seconds);
}

// Форматирование чисел
function pad(n) {
    return n < 10 ? '0' + n : n;
}

// Установка значений таймера
function setTimerDisplay(d, h, m, s) {
    const elements = {
        days: document.getElementById('days'),
        hours: document.getElementById('hours'),
        minutes: document.getElementById('minutes'),
        seconds: document.getElementById('seconds')
    };

    // Проверяем наличие элементов
    Object.entries(elements).forEach(([key, element]) => {
        if (element) {
            switch (key) {
                case 'days':
                    element.textContent = pad(d);
                    break;
                case 'hours':
                    element.textContent = pad(h);
                    break;
                case 'minutes':
                    element.textContent = pad(m);
                    break;
                case 'seconds':
                    element.textContent = pad(s);
                    break;
            }
        }
    });
}

// Очистка таймера
function cleanupTimer() {
    if (timerInterval) {
        clearInterval(timerInterval);
        timerInterval = null;
    }
}

// Инициализация при загрузке DOM
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initTimer);
} else {
    initTimer();
}

// Очистка при размонтировании
window.addEventListener('beforeunload', cleanupTimer);
