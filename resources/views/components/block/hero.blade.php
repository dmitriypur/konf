<section class="relative pt-55 lg:pt-35">
    <div class="absolute -top-10 left-[50%] -translate-x-1/2 w-full max-w-470 -z-10">
        <img data-src="{{ asset('images/bg-hero-circles.webp') }}" alt="Фон из кружков" class="lazy">
    </div>
    <div
        id="follower"
        class="hidden lg:block circle-gr w-80 h-80 bg-linear-(--violet3-gr) rounded-full fixed w-[320px] h-[320px] before:p-2 pointer-events-none -z-100"
        style="top: 0; left: 0;"
    ></div>
    <div class="container mx-auto pt-5 pb-8  lg:py-16">
        <div class="flex flex-col md:flex-row relative px-3">
            <div class="max-w-140 relative">
                <div class="absolute md:animate-[reverse-rotate_8s_ease-in-out_infinite] rotate-270 md:-rotate-20 w-40 h-auto top-70 md:-top-14 left-65 md:left-90 -z-10">
                    <img data-src="{{ asset('images/pink-ring.webp') }}" alt="Розовое колечко" width="160" height="145"
                         class="w-full lazy">
                </div>

                <div class="absolute left-1/2 -top-50 w-492 h-auto -z-10">
                    <img data-src="{{ asset('images/morph.webp') }}" alt="Разноцветное облако" width="1967" height="1295"
                         class="w-full lazy">
                </div>
                <div class="absolute -left-10 top-10 w-100 h-400 bg-linear-(--violet-gr) opacity-50 md:-left-1/3 md:w-100 md:h-100 md:bg-purple rounded-full blur-[70px] -z-10"></div>
                <small class="text-white/70 text-[10px] md:text-sm font-normal flex items-center justify-between">ул. Вильгельма Пика, д.16, Москва <b class="block text-white text-base lg:text-lg lg:mr-20">21/09/25 </b></small>
                <h1 class="text-[36px]/10 md:text-[55px]/15 font-bold">
                    <span class="font-sans">III</span> Национальная конференция <span
                        class="block">"Оптика Будущего"</span>
                </h1>
                <div class="grid md:grid-cols-2 mt-6 md:mt-12 gap-4">
                    <div class="flex items-center gap-4 md:gap-2">
                        <span class="text-white w-3.5 h-3"><x-icons.plus></x-icons.plus></span>
                        Реальные кейсы
                    </div>
                    <div class="flex items-center gap-4 md:gap-2">
                        <span class="text-white w-3.5 h-3"><x-icons.plus></x-icons.plus></span>
                        Точки роста
                    </div>
                    <div class="flex items-center gap-4 md:gap-2">
                        <span class="text-white w-3.5 h-3"><x-icons.plus></x-icons.plus></span>
                        Практические инструменты
                    </div>
                    <div class="flex items-center gap-4 md:gap-2">
                        <span class="text-white w-3.5 h-3"><x-icons.plus></x-icons.plus></span>
                        Лидеры отрасли
                    </div>
                </div>
                <div class="hidden relative md:grid grid-cols-2 mt-12 gap-y-8 gap-x-3 font-secondary max-w-125">
                    <button type="button"
                            data-modal-target="form3"
                            class="open-modal-btn btn-gr-pink text-xl w-full h-20 col-span-full rounded-full before:rounded-full before:p-0.5 cursor-pointer backdrop-blur-lg">
                        Зарегистрироваться на конференцию
                        <span class="bg-gr"></span>
                    </button>
                    <button type="button"
                            data-modal-target="form1"
                            class="open-modal-btn btn-gr-pink w-full h-15 col-span-1 rounded-full before:rounded-full before:p-0.5 cursor-pointer backdrop-blur-lg">
                        Стать спикером
                        <span class="bg-gr"></span>
                    </button>
                    <button type="button"
                            data-modal-target="form2"
                            class="open-modal-btn btn-gr-pink w-full h-15 col-span-1 rounded-full before:rounded-full before:p-0.5 cursor-pointer backdrop-blur-lg">
                        Стать партнёром
                        <span class="bg-gr"></span>
                    </button>
                </div>
            </div>
            <div class="relative flex-auto flex flex-col justify-center">
                <span class="absolute left-75 -bottom-30 z-10 md:z-0 md:left-full md:-bottom-20 md:-translate-x-20 w-24 h-auto">
                    <img data-src="{{ asset('images/blue-cylinder.webp') }}" alt="Голубой цилиндр" width="95" height="85" class="lazy">
                </span>
                <div class="hidden md:block absolute md:-rotate-20 w-40 h-auto md:left-40 md:bottom-5 -z-10">
                    <img data-src="{{ asset('images/pink-ring.webp') }}" alt="Розовое колечко" width="160" height="145"
                         class="w-full lazy">
                </div>
                <ul class="hidden md:block w-full max-w-70 z-10">
                    <li class="btn-gr hover:animate-[wiggle_1s_ease-in-out_infinite] rounded-full before:rounded-full text-[46px] font-bold flex items-center justify-evenly px-10 w-full h-20 mb-4 backdrop-blur-lg">
                        22+ <b class="text-pink font-secondary text-xl">года опыта</b>
                    </li>
                    <li class="btn-gr hover:animate-[wiggle_1s_ease-in-out_infinite] rounded-full before:rounded-full text-[46px] font-bold flex items-center justify-evenly px-10 w-full h-20 mb-4 backdrop-blur-lg">
                        50+ <b class="text-pink font-secondary text-xl">участников</b>
                    </li>
                    <li class="btn-gr hover:animate-[wiggle_1s_ease-in-out_infinite] rounded-full before:rounded-full text-[46px] font-bold flex items-center justify-evenly px-10 w-full h-20 backdrop-blur-lg">
                        8 <b class="text-pink font-secondary text-xl">топовых тем</b>
                    </li>
                </ul>
                <x-hero-mobile></x-hero-mobile>
            </div>
        </div>
        <div class="relative mt-23 px-3 z-10 lg:px-0">
            <ul class="grid lg:grid-cols-3 gap-5 lg:gap-10">
                <li class="circle-gr bg-linear-(--white2-gr) inline-flex items-center px-10 py-6 rounded-3xl before:rounded-3xl before:bg-linear-(--white3-gr) before:p-[3px] after:bg-linear-(--pink-gr) after:rounded-3xl after:p-[3px] after:opacity-100 lg:after:opacity-0 hover:after:opacity-100 hover:-translate-y-1 hover:[&_span]:border-0 hover:[&_span]:bg-linear-(--pink-gr) backdrop-blur-lg font-secondary transition-transform">
                    <span
                        class="inline-flex items-center justify-center w-17 h-17 rounded-full bg-linear-(--pink-gr) lg:bg-linear-(--white4-gr) border border-white/10 mr-5 transition-color">
                        <x-icons.user></x-icons.user>
                    </span>
                    <p><b class="font-primary mr-1">CEO</b> уровень участников</p>
                </li>
                <li class="circle-gr bg-linear-(--white2-gr) inline-flex items-center px-10 py-6 rounded-3xl before:rounded-3xl before:bg-linear-(--white3-gr) before:p-[3px] after:bg-linear-(--pink-gr) after:rounded-3xl after:p-[3px] after:opacity-0 hover:after:opacity-100 hover:-translate-y-1 hover:[&_span]:border-0 hover:[&_span]:bg-linear-(--pink-gr) backdrop-blur-lg font-secondary transition-transform">
                    <span
                        class="inline-flex items-center justify-center w-17 h-17 rounded-full bg-white/5 border border-white/10 mr-5">
                        <x-icons.hand-bag></x-icons.hand-bag>
                    </span>
                    Решения, которые работают
                </li>
                <li class="circle-gr bg-linear-(--white2-gr) inline-flex items-center px-10 py-6 rounded-3xl before:rounded-3xl before:bg-linear-(--white3-gr) before:p-[3px] after:bg-linear-(--pink-gr) after:rounded-3xl after:p-[3px] after:opacity-0 hover:after:opacity-100 hover:-translate-y-1 hover:[&_span]:border-0 hover:[&_span]:bg-linear-(--pink-gr) backdrop-blur-lg font-secondary transition-transform">
                    <span
                        class="inline-flex items-center justify-center w-17 h-17 rounded-full bg-white/5 border border-white/10 mr-5">
                        <x-icons.users></x-icons.users>
                    </span>
                    лекции и живые интенсивы
                </li>
            </ul>
            <div class="absolute w-50 h-auto -left-20 -bottom-30 md:w-70 md:h-auto md:-left-40 md:-bottom-18 md:rotate-270 -z-40">
                <img data-src="{{ asset('images/pink-ring.webp') }}" alt="Розовое колечко" width="440" height="300"
                     class="w-full lazy">
            </div>
        </div>
    </div>
</section>
