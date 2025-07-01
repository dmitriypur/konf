// document.querySelectorAll('.bitrix-form').forEach(function(form) {
    document.addEventListener('submit', function(e) {
        e.preventDefault();

        if(!e.target.classList.contains('bitrix-form')){
            return false;
        }
        const form = e.target;
        const loader = form.querySelector('.form-loader');
        const alertBox = form.querySelector('.form-alert');

        alertBox.classList.add('hidden');
        alertBox.textContent = '';

        const formData = new FormData(form);

        formData.append('form_type', form.dataset.form);
        formData.append('form_name', form.dataset.name);

        // Простая валидация
        const requiredFields = form.querySelectorAll('[data-required]');
        let valid = true;

        requiredFields.forEach(function(input) {
            const value = input.value.trim();
            input.classList.remove('border-red-500');

            if (!value) {
                valid = false;
                input.parentNode.classList.add('before:bg-red-600');
                input.parentNode.classList.remove('before:bg-linear-(--white2-gr)');
            }
        });

        if (!valid) {
            showAlert('Пожалуйста, заполните обязательные поля', 'error');
            return;
        }

        // Показать loader
        loader.classList.remove('hidden');

        fetch('/send-bitrix', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
            .then(res => res.json())
            .then(data => {
                loader.classList.add('hidden');
                if (data.success) {
                    showAlert('Заявка успешно отправлена!', 'success');
                    form.reset();
                } else {
                    showAlert('Ошибка отправки. Попробуйте позже.', 'error');
                }
            })
            .catch(err => {
                loader.classList.add('hidden');
                showAlert('Ошибка сети. Повторите попытку.', 'error');
                console.error(err);
            });

        function showAlert(message, type) {
            alertBox.textContent = message;
            alertBox.classList.remove('hidden');

            if (type === 'success') {
                alertBox.className = 'form-alert text-xs text-center text-white bg-green-600 p-2 rounded-xl';
            } else {
                alertBox.className = 'form-alert text-xs text-center text-white bg-red-400 p-2 rounded-xl';
            }
        }

    });

// });

