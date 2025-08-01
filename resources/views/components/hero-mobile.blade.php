<div class="relative overflow-hidden max-w-90 rounded-(--radius-40) top-6 md:-top-8 left-8 md:absolute md:left-75 rotate-6 md:rotate-11 backdrop-blur-lg">
    <div class="w-full md:w-83 h-144">
        <div class="circle-gr w-full h-full bg-linear-(--white4-gr) before:bg-linear-(--pink4-gr) before:p-1 rounded-(--radius-40) before:rounded-(--radius-40) "></div>
    </div>
    <div class="absolute inset-0 py-4 px-5">
        <div class="flex items-center justify-between">
            <span>9:41</span>
            <span>
                <img src="{{ asset('images/right-side.svg') }}" alt="Верхняя панель смартфона">
            </span>
        </div>
        <div class="relative h-72.5 mt-2">
            <span class="absolute vertical-white-gr before:p-0.5 bg-linear-(--white-vertical-gr) mix-blend-overlay rounded-2xl before:rounded-2xl inset-0 -z-10"></span>
            <a href="https://t.me/OpticaFuture" target="_blank" class="flex items-center justify-start gap-6 px-5 rounded-2xl bg-white/40 border border-white w-full h-15 text-sm text-white font-semibold">
                <img src="{{ asset('images/icon-tg.svg') }}" alt="Иконка открытый конверт" width="40" height="40">
                Оптика Будущего
            </a>
            <div class="hidden flex items-center justify-between text-sm font-semibold mt-5 px-3">
                <div class="btn-gr flex items-center justify-center w-13 h-13 rounded-xl before:rounded-xl">
                    <img src="{{ asset('images/mail-open.svg') }}" alt="Иконка открытый конверт" width="24" height="24">
                </div>
                @OpticaFuture
                <div class="btn-gr flex items-center justify-center w-13 h-13 rounded-xl before:rounded-xl">
                    <img src="{{ asset('images/share-ios-export.svg') }}" alt="Иконка экспорт" width="24" height="24">
                </div>
            </div>
            <div class="mt-12">
                <x-timer :time="$time"></x-timer>
            </div>
            <div class="flex justify-between mt-12 px-3 text-xl">
                <div class="flex items-center font-secondary">
                    <img src="{{ asset('images/map.svg') }}" alt="Иконка метка на карте">
                    <p>Москва</p>
                </div>
                <div class="flex items-center font-medium">
                    <img src="{{ asset('images/calendar.svg') }}" alt="Иконка календарь">
                    <p>{{ Carbon\Carbon::parse($time)->format('d/m/Y') }}</p>
                </div>
            </div>
        </div>
        <div class="relative flex items-center gap-4 rounded-full circle-gr bg-white p-[2px] mt-2.5 after:-z-10">
            <div class="bg-linear-(--violet-gr) text-xs font-bold rounded-full h-full py-1 px-2">- 5000 руб.</div>
            <p class="text-xs font-semibold text-my-dark-blue">за второго участника</p>
        </div>
        <a href="#tariffs"
                class="flex items-center justify-center btn-gr-pink before:p-0.5 w-full h-15 font-secondary col-span-full rounded-full before:rounded-full backdrop-blur-lg mt-4.5">
            Зарегистрироваться
            <span class="bg-gr"></span>
        </a>
        <button type="button"
                data-modal-target="form1"
                class="open-modal-btn btn-gr-pink before:p-0.5 w-full h-15 font-secondary col-span-1 rounded-full before:rounded-full cursor-pointer backdrop-blur-lg mt-4.5">
            Стать спикером
            <span class="bg-gr"></span>
        </button>
        <div class="w-33.5 h-1.5 bg-white rounded-full mx-auto mt-4.5"></div>
    </div>
</div>
