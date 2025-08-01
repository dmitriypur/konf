<template id="form3">
    <div class="circle-gr h-[95vh] mt-4 py-6 md:py-10 relative max-w-[488px] mx-auto bg-linear-(--pink3-gr) p-[2px] rounded-[32px] backdrop-blur-lg before:bg-linear-(--violet4-gr) before:p-1 before:rounded-[30px] before:-z-10 after:-z-10">
        <form
            data-name="Форма 'Стать участником'"
            data-form="form3"
            class="bitrix-form px-6 h-full overflow-y-auto scrollbar-hide md:px-20 rounded-[30px] text-white space-y-5">
            <!-- Заголовок -->
            <div class="flex items-start justify-between">
                <h2 class="text-5xl/9">стать<br>участником</h2>
                <img src="{{ asset('images/logo-transparent.svg') }}" alt="логотип" class="w-19 h-19"/>
            </div>


            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="text" placeholder="*Город" data-required name="city"
                       class="w-full rounded-full px-6 py-3 bg-white/15 placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30"/>
            </div>
            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="text" placeholder="*Организация" data-required name="org"
                       class="w-full rounded-full px-6 py-3 bg-white/15 placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30"/>
            </div>
            <div
                class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                <input type="text" placeholder="*Бренд" data-required name="brand"
                       class="w-full rounded-full px-6 py-3 bg-white/15 placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30"/>
            </div>

            <div class="user-data mt-10 space-y-5">
                <div
                    class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                    <input type="text" placeholder="*ФИО" data-required name="people[0][fio]"
                           class="w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
                </div>
                <div
                    class="phone circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                    <input type="tel" placeholder="*Номер телефона" data-required name="people[0][phone]"
                           class="phone-input w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
                </div>
                <div
                    class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                    <input type="text" placeholder="Telegram ID" name="people[0][telegram]"
                           class="w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
                </div>
                <div
                    class="circle-gr relative rounded-full before:bg-linear-(--white2-gr) before:p-[1px] before:rounded-[30px] before:-z-10 after:-z-10">
                    <input type="email" placeholder="E-mail" name="people[0][email]"
                           class="w-full rounded-full px-6 py-3 bg-[rgba(255,255,255,0.15)] placeholder-white/70 text-white outline-none focus:ring-2 focus:ring-white/30 transition"/>
                </div>
            </div>
            <input type="hidden" name="tariff_id" value="18">
            <input type="hidden" name="form_name" value="3">
            <input type="hidden" name="price" value="30000">
            <button type="button" id="add-user" class="add-user circle-gr text-sm mt-8 relative w-full py-2 px-5 flex items-center justify-center gap-x-3 rounded-full [&_svg]:w-3 before:rounded-full before:bg-linear-(--white-gr) before:p-[1px] cursor-pointer">
                <x-icons.plus></x-icons.plus>
                Добавить ещё одного участника
                <span class="absolute rounded-full inset-0 bg-linear-(--white-gr) mix-blend-overlay"></span>
                <span class="circle-gr top-8 absolute overflow-hidden bg-linear-(--pink-gr) w-auto py-1 px-2  rounded-full [&_svg]:w-3 before:rounded-full before:bg-linear-(--white2-gr) before:p-0.5 z-20">- 5 000 руб.</span>
            </button>

            <!-- Alert -->
            <div class="form-alert hidden text-sm mt-2"></div>

            <!-- Loader -->
            <div class="form-loader hidden absolute inset-0 bg-white/60 flex items-center justify-center z-10">
                <span class="animate-spin h-6 w-6 border-4 border-gray-300 border-t-blue-500 rounded-full"></span>
            </div>

            <!-- Кнопка -->
            <button type="submit"
                    class="btn-gr-pink w-full h-13 rounded-full before:p-0.5 before:rounded-full cursor-pointer mt-7">
                отправить заявку
                <span class="bg-gr"></span>
            </button>

            <!-- Checkbox -->
            <label class="flex items-start space-x-3 text-[10px] mt-4 leading-snug text-white">
                <input
                    type="checkbox"
                    class="peer sr-only"
                    name="agree"
                    checked
                    data-required
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
                    Я даю согласие на обработку персональных данных и соглашаюсь с <a href="{{ route('privacy-policy') }}" target="_blank" class="underline">политикой конфиденциальности</a>
                  </span>
            </label>

        </form>
    </div>

</template>
