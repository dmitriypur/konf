<section class="relative py-8" id="tariffs">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-9 px-3 lg:px-0">
            <div class="bg-[rgba(31, 52, 98, 0.09)] border rounded-(--radius-40) relative before:absolute before:inset-0 before:backdrop-blur-md before:-z-10">
                <div class="p-6 lg:py-8 lg:px-10">
                    <p class="lg:font-semibold text-white/50 lg:text-white">Стоимость участия</p>
                    <h3 class="text-[40px]/10 lg:text-[55px]/11">Тариф “Бизнес”</h3>
                </div>
                <div class="relative flex flex-col lg:flex-row gap-x-2 p-6 lg:py-8 lg:px-10 border-y-1 before:absolute before:inset-0 before:bg-linear-(--white3-gr) before:mix-blend-overlay before:-z-10">
                    <div class="w-4/5 lg:w-2/5 lg:min-w-2/5">
                        <h4 class="text-3xl/7">Что включено в&nbsp;тариф:</h4>
                        <img data-src="{{ asset('images/tariff-1.webp') }}" alt="Картинка слои цветная" width="168" height="109" class="absolute top-4 right-4 max-w-28 lg:max-w-full lg:relative lg:mt-15">
                    </div>
                    <div class="flex-auto mt-4 lg:mt-0">
                        <ul class="flex flex-col gap-2">
                            @foreach($block->payload['tariff_1'] as $item)
                                <li class="pl-6" style="background: url({{ asset('images/plus.svg') }}) no-repeat center left">{{ $item['title'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="relative p-6 lg:p-8">
                    <p class="text-xs lg:text-base">{{ $block->payload['text_1'] }}</p>
                    <div class="relative flex items-center gap-2 lg:gap-4 rounded-full bg-white p-[2px] mt-2.5">
                        <div class="bg-linear-(--violet-gr) text-xs text-center font-bold rounded-full w-14 lg:w-43 h-full py-1 px-2">-20%</div>
                        <p class="flex-auto text-xs text-center text-[#1F3462] font-medium">специальная цена до 1 августа</p>
                    </div>
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-y-2 gap-x-8 mt-8.5">
                        <div class="relative font-bold text-[32px] lg:text-[40px]">{{ $block->payload['price_1'] }} <del class="absolute -top-5 md:right-0 block text-lg md:text-xl text-white/50 font-normal">{{ $block->payload['old_price_1'] }}</del></div>
                        <button type="button"
                                data-modal-target="form3"
                                data-price="24000"
                                data-tariff="18"
                                class="open-modal-btn flex-auto btn-gr-pink before:p-0.5 w-full lg:w-auto h-20 font-secondary col-span-1 rounded-full before:rounded-full cursor-pointer backdrop-blur-lg">
                            стать участником
                            <span class="bg-gr"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="bg-[rgba(31, 52, 98, 0.09)] border rounded-(--radius-40) relative before:absolute before:inset-0 before:backdrop-blur-md before:-z-10">
                <div class="p-6 lg:py-8 lg:px-10 relative">
                    <p class="lg:font-semibold text-white/50 lg:text-white">Стоимость участия</p>
                    <h3 class="text-[38px]/10 lg:text-[55px]/11">Тариф <span class="text-pink">“премиум”</span></h3>
                    <img data-src="{{ asset('images/star-violet.webp') }}" alt="Цветная звезда на фоне облака" width="95" height="92" class="absolute top-30 right-2 lg:top-4 lg:-right-4 z-10">
                </div>
                <div class="relative flex flex-col lg:flex-row gap-x-2 p-6 lg:py-8 lg:px-10 border-y-1 before:absolute before:inset-0 before:bg-linear-(--violet-gr)  before:-z-10 before:opacity-70">
                    <div class="w-4/5 lg:w-2/5 lg:min-w-2/5">
                        <h4 class="text-3xl/7">Что включено в&nbsp;тариф:</h4>
                        <img data-src="{{ asset('images/tariff-2.svg') }}" alt="Картинка слои цветная" width="168" height="109" class="hidden lg:block mt-15">
                    </div>
                    <div class="flex-auto mt-4 lg:mt-0">
                        <div class="relative pl-6 font-semibold before:absolute before:top-1/2 before:right-0 before:-translate-y-1/2 before:h-7.5 before:w-1.5 before:border-y before:border-e before:rounded-r-sm" style="background: url({{ asset('images/plus.svg') }}) no-repeat center left">Все из тарифа “Бизнес”</div>
                        <div class="flex justify-end text-base/4 py-2">
                            +
                        </div>
                        <ul class="relative flex flex-col gap-4 before:absolute before:top-1/2 before:right-0 before:-translate-y-1/2 before:h-full before:w-1.5 before:border-y before:border-e before:rounded-r-sm">
                            @foreach($block->payload['tariff_2'] as $item)
                                <li class="pl-6 text-sm/5" style="background: url({{ asset('images/plus.svg') }}) no-repeat center left">{{ $item['title'] }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="relative p-6 lg:p-8">
                    <p class="text-xs lg:text-base">{{ $block->payload['text_2'] }}</p>
                    <div class="relative flex items-center gap-2 lg:gap-4 rounded-full bg-white p-[2px] mt-2.5">
                        <div class="bg-linear-(--violet-gr) text-xs text-center font-bold rounded-full w-14 lg:w-43 h-full py-1 px-2">-20%</div>
                        <p class="flex-auto text-xs text-center text-[#1F3462] font-medium">специальная цена до 1 августа</p>
                    </div>
                    <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-y-2 gap-x-8 mt-8.5">
                        <div class="relative font-bold text-[32px] lg:text-[40px]">{{ $block->payload['price_2'] }} <del class="absolute -top-5 md:right-0 block text-lg md:text-xl text-white/50 font-normal">{{ $block->payload['old_price_2'] }}</del></div>
                        <button type="button"
                                data-modal-target="form3"
                                data-price="28000"
                                data-tariff="14"
                                class="open-modal-btn flex-auto btn-gr-pink before:p-0.5 w-full lg:w-auto h-20 font-secondary col-span-1 rounded-full before:rounded-full cursor-pointer backdrop-blur-lg">
                            стать участником
                            <span class="bg-gr"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
