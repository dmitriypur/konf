<footer>
    <div class="lg:border-y border-white/20">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-x-19 px-3">
                <div class="logo relative">
                    <picture>
                        <source srcset="{{ asset('images/logo-f.webp') }}" media="(min-width: 768px)">
                        <img src="{{ asset('images/logo-f-m.webp') }}" alt="логотип" class="w-full h-auto">
                    </picture>
                </div>
                <div class="py-8 hidden lg:block">
                    <p class="font-medium text-lg mb-6">Оптика Будущего</p>
                    <nav class="absolute left-10 bottom-14 lg:bottom-0 lg:left-0 lg:relative" data-da=".logo,1024,1">
                        <ul class="flex flex-col font-semibold lg:font-normal gap-y-1 lg:gap-y-2">
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">О конференции</a>
                            </li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Программа</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Спикеры</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Регистрация</a>
                            </li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Партнеры</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Место и
                                    контакты</a></li>
                            <li><a href="#" class="text-white/70 hover:text-white transition-colors">Как это было</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="flex-auto py-8">
                    <div class="flex w-full relative">
                        <div class="w-full lg:max-w-md">
                            <p class="font-medium text-lg text-center lg:text-left">Присоединяйсь к нашему сообществу в&nbsp;Telegram</p>
                            <a href="#"
                               class="flex items-center justify-center lg:max-w-75 h-15 lg:h-12.5 mt-6 circle-gr relative rounded-full bg-linear-(--blue-gr) before:bg-linear-(--white-gr) before:p-[2px] before:rounded-full hover:bg-sky-700 transition-colors">Наш
                                Telegram</a>
                        </div>
                        <img src="{{ asset('images/folders.webp') }}" alt="Иконка папки" width="98" height="93"
                             class="absolute w-40 lg:w-auto h-auto right-full top-2 lg:top-0 lg:right-0" data-da=".bottom-footer,1024,1">
                    </div>
                    <div class="flex flex-col lg:flex-row gap-6.5 mt-6 lg:mt-20">
                        <button type="button"
                                data-modal-target="form1"
                                class="open-modal-btn btn-gr-pink w-full h-15 col-span-1 rounded-full before:rounded-full before:p-0.5 cursor-pointer backdrop-blur-lg font-secondary text-xl">
                            Стать спикером
                            <span class="bg-gr"></span>
                        </button>
                        <button type="button"
                                data-modal-target="form2"
                                class="open-modal-btn btn-gr-pink w-full h-15 col-span-1 rounded-full before:rounded-full before:p-0.5 cursor-pointer backdrop-blur-lg font-secondary text-xl">
                            Стать партнёром
                            <span class="bg-gr"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="bottom-footer relative py-6 lg:py-10 pr-3 pl-6 lg:px-0 w-full max-w-2/3 float-right lg:max-w-full lg:float-none">
        <div class="flex flex-col gap-5 lg:gap-0 lg:flex-row justify-between mx-auto lg:max-w-234">
            <div class="flex items-center lg:justify-center gap-2 flex-auto">
                <img src="{{ asset('images/map.svg') }}" alt="Иконка метки на карте" width="32" height="32">
                <a href="#" class="hover:text-pink transition-colors">ул. Вильгельма Пика, д.16, Москва</a>
            </div>
            <div class="flex items-center lg:justify-center gap-2 flex-auto">
                <img src="{{ asset('images/email.svg') }}" alt="Иконка конверт" width="32" height="32">
                <a href="mailto:support@norch.ai" class="hover:text-pink transition-colors">support@norch.ai</a>
            </div>
            <div class="flex items-center lg:justify-center gap-2 flex-auto">
                <img src="{{ asset('images/call.svg') }}" alt="Иконка телефон" width="32" height="32">
                <a href="tel:80001234567" class="hover:text-pink transition-colors">+8 (000) 123-4567</a>
            </div>
        </div>
    </div>
</footer>
<!-- Скрытые шаблоны форм -->




<x-forms.speacker></x-forms.speacker>
<x-forms.partner></x-forms.partner>
<x-forms.register></x-forms.register>
<x-video></x-video>


<div id="modal" class="fixed inset-0 z-50 bg-black/50 flex items-start justify-center hidden">
    <div class="relative">
        <button id="modal-close" class="absolute top-2 right-2 w-full opacity-0">✖</button>
        <div id="modal-content"></div>
    </div>
</div>
