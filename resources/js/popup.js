document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const modalContent = document.getElementById('modal-content');
    const modalClose = document.getElementById('modal-close');

    document.querySelectorAll('.open-modal-btn').forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.modalTarget;
            const template = document.getElementById(targetId);

            if (template) {
                modalContent.innerHTML = ''; // Очищаем перед вставкой
                modalContent.appendChild(template.content.cloneNode(true));
                modal.classList.remove('hidden');
            }

            phoneMask();
            const form = document.querySelector('form');
            const requiredFields = form.querySelectorAll('[data-required]');
            requiredFields.forEach(function(input) {

                input.addEventListener('input', function (e) {
                    if (e.target.value.trim().length < 2) {
                        input.parentNode.classList.add('before:bg-red-600');
                        input.parentNode.classList.remove('before:bg-linear-(--white2-gr)', 'before:bg-linear-(--violet-gr)');
                    }else{
                        input.parentNode.classList.add('before:bg-green-600');
                        input.parentNode.classList.remove('before:bg-red-600');
                    }
                })
            });
        });
    });

    // Закрытие по кнопке
    modalClose.addEventListener('click', () => {
        modal.classList.add('hidden');
        modalContent.innerHTML = '';
    });

    // Закрытие по клику вне окна
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modalContent.innerHTML = '';
        }
    });
});
function phoneMask(){
    const phoneInput = document.querySelector('.phone-input');
    phoneInput.addEventListener('input', function (e){
        let x = phoneInput.value.replace(/\D/g, '').substring(1); // удаляем всё кроме цифр
        let formatted = '+7';
        if (x.length > 0) formatted += ' (' + x.substring(0, 3);
        if (x.length >= 3) formatted += ') ' + x.substring(3, 6);
        if (x.length >= 6) formatted += '-' + x.substring(6, 8);
        if (x.length >= 8) formatted += '-' + x.substring(8, 10);
        phoneInput.value = formatted;
    })
}
