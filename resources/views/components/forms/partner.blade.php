<template id="form2">
    <div class="circle-gr relative py-6 md:py-10 mt-4 max-h-[600px] h-[95vh] max-w-[488px] mx-auto bg-linear-(--white2-gr) p-[2px] rounded-[32px] backdrop-blur-lg before:bg-linear-(--violet4-gr) before:p-1 before:rounded-[30px] before:-z-10 after:-z-10">
        <div class="absolute inset-0 w-full h-full -z-10 rounded-[32px] overflow-hidden">
            <img src="{{ asset('images/form-partner.webp') }}" alt="Цветное облако" width="400" height="355" class="w-full h-full object-cover">
        </div>
        <div class="w-full h-full">
        <form
            data-name="Форма 'Стать партнером'"
            data-form="form2"
            class="bitrix-form px-6 h-full overflow-y-auto scrollbar-hide md:px-20 rounded-[30px] text-white space-y-5 ">
            <!-- Заголовок -->
            <div class="flex items-start justify-between">
                <h2 class="text-5xl/9">стать<br>партнером</h2>
                <img src="{{ asset('images/logo-transparent.svg') }}" alt="логотип" class="w-19 h-19"/>
            </div>

            <!-- Поля формы -->
            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="text" placeholder="*Организация" data-required name="org"
                       class="w-full rounded-full px-6 py-3 bg-white/15 placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30"/>
            </div>

            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="text" placeholder="*ФИО" data-required name="fio"
                       class="w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
            </div>
            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="tel" placeholder="*Номер телефона" data-required name="phone"
                       class="phone-input w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
            </div>
            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="email" placeholder="E-mail" name="email"
                       class="w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
            </div>

            <!-- Alert -->
            <div class="form-alert hidden text-sm mt-2"></div>

            <!-- Loader -->
            <div class="form-loader hidden absolute inset-0 bg-white/60 flex items-center justify-center z-10">
                <span class="animate-spin h-6 w-6 border-4 border-gray-300 border-t-blue-500 rounded-full"></span>
            </div>

            <!-- Кнопка -->
            <button type="submit"
                    class="btn-gr w-full h-13 rounded-full before:rounded-full cursor-pointer mt-4">
                отправить заявку
                <span class="bg-gr mix-blend-overlay"></span>
            </button>

            <!-- Checkbox -->
            <label class="flex items-start space-x-3 text-[10px] mt-4 leading-snug text-white">
                <input
                    type="checkbox"
                    class="peer sr-only"
                    required
                    checked
                />
                <div
                    class="w-5 h-5 border border-white rounded-md flex-shrink-0 relative flex items-center justify-center transition-all duration-200 peer-checked:[&_svg]:opacity-100"
                >
                    <!-- Галочка -->
                    <svg width="13" height="10" viewBox="0 0 13 10" fill="none" xmlns="http://www.w3.org/2000/svg"
                         class="absolute w-3 h-3 text-black opacity-0  transition-opacity duration-200">
                        <path d="M1 4.99998L4.53553 8.53551L11.6058 1.46442" stroke="white" stroke-width="2"
                              stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>

                <span>
                    Я даю согласие на обработку персональных данных и соглашаюсь с <a href="#" class="underline">политикой конфиденциальности</a>
                  </span>
            </label>

        </form>
        </div>
    </div>

</template>
