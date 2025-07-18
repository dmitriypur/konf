<section id="location" class="relative py-8">
    <div class="hidden lg:block absolute left-1/2 -top-200 -translate-x-1/2 w-820 -z-10">
        <img data-src="{{ asset('images/bg-bottom.webp') }}" alt="Фоновое изображение разноцветное облако" width="3276" height="4500" class="lazy">
    </div>
    <div class="lg:hidden absolute left-1/2 -top-40 -translate-x-1/2 w-528 -z-10">
        <img data-src="{{ asset('images/bg-mobile-location.webp') }}" class="lazy" alt="Фоновое изображение разноцветное облако" width="2114" height="2347">
    </div>
    <div class="container mx-auto">
        <div class="lg:flex px-3 lg:px-0">
            <div class="">
                <h2 class="relative text-center max-w-90 mx-auto lg:max-w-full lg:text-left text-[40px]/9 lg:text-[64px]/20 pb-20 lg:pb-0 lg:pl-24 z-20">
                    {{ $block->title }}
                    <span class="absolute w-35 lg:w-50 h-auto top-10 lg:top-20 right-full translate-x-full lg:translate-x-0 lg:-right-18 lg:-translate-y-2 z-10">
                        <img data-src="{{ asset('images/circle-pointer.svg') }}" class="lazy" alt="Указатель на картинку" width="200" height="74">
                    </span>
                    <span class="w-16.5 lg:w-auto absolute left-1/2 -translate-x-1/2 lg:translate-x-0 top-16 lg:top-0 lg:left-0">
                        <img data-src="{{ asset('images/map-marker.webp') }}" alt="Иконка метка на карте" width="77" height="79" class="w-full lazy">
                    </span>
                </h2>
                <div class="mt-10 lg:mt-20">
                    <div class="flex justify-center lg:justify-start lg:gap-x-7">
                        <div data-da=".locations,1024,1" class="circle-gr relative w-full lg:max-w-44 h-auto overflow-hidden rounded-4xl before:rounded-4xl before:bg-linear-(--white2-gr) before:p-1">
                            <img data-src="{{ 'storage/' . $block->payload['pic-1'] }}" alt="Конференц зал" class="lazy w-full h-full object-cover">
                        </div>
                        <div class="flex flex-col items-center lg:block">
                            <img data-src="{{ asset('images/rating-stars.svg') }}" alt="Звездный рейтинг" width="117" height="29" class="lazy order-2 mt-2 lg:mt-0">
                            <p class="text-3xl text-center font-bold mt-2 order-1">{{ $block->payload['name_hotel'] }}</p>
                            <span class="block w-full h-[1px] bg-linear-(--white-vertical2-gr) mt-7.5 order-3"></span>
                            <p class="mt-5 text-xl lg:text-2xl tracking-tight order-4">{{ $block->payload['address'] }}</p>
                        </div>
                    </div>
                    <div class="w-full h-auto mt-6 relative lg:hidden">
                        <img data-src="{{ 'storage/' . $block->payload['pic-main-mobile'] }}" alt="Отель" width="370" height="307" class="lazy w-full">
                        <a href="tel:74951392020" class="absolute left-4 bottom-2 font-semibold">+7 495 139 20 20</a>
                    </div>
                    <div class="locations grid grid-cols-2 lg:flex gap-4 lg:gap-x-7 mt-6 lg:mt-16 lg:pr-6">
                        <div class="circle-gr relative w-full lg:max-w-44 h-auto overflow-hidden rounded-4xl before:rounded-4xl before:bg-linear-(--white2-gr) before:p-1">
                            <img data-src="{{ 'storage/' . $block->payload['pic-2'] }}" alt="Конференц зал" class="lazy w-full h-full object-cover">
                        </div>
                        <div class="col-span-2 w-full flex flex-col gap-8 lg:gap-0">
                            <div class="grid grid-cols-2 gap-x-4 lg:gap-x-7.5">
                                <a href="https://yandex.ru/maps/org/soluxe_hotel_moscow/124173523175/?indoorLevel=1&ll=37.633013%2C55.844870&z=17" target="_blank" class="btn-gr flex items-center justify-center w-full h-14 rounded-full before:rounded-full font-secondary text-sm">
                                    открыть карту
                                    <span class="bg-gr"></span>
                                </a>
                                <a href="https://taxi.yandex.ru/order?gfrom=,&gto=55.844723,37.634604&tariff=econom&lang=ru&utm_source=yamaps&utm_medium=2334692&ref=2334692" target="_blank" class="btn-gr flex items-center justify-center w-full h-14 rounded-full before:rounded-full font-secondary text-sm">
                                    Заказать такси
                                    <span class="bg-gr"></span>
                                </a>
                            </div>
                            <div class="flex gap-2 items-center justify-between mt-auto">
                                <a href="https://vk.com/soluxehotelmoscow" target="_blank" class="circle-gr overflow-hidden relative bg-linear-(--white3-gr) py-1.5 px-7 flex items-center justify-center rounded-full before:bg-linear-(--white2-gr) before:p-0.5 before:rounded-full underline hover:no-underline hover:[&_span]:opacity-100">
                                    <span class="absolute inset-0 bg-linear-(--violet-gr) z-10 mix-blend-overlay opacity-0 transition-opacity"></span>
                                    VK
                                </a>
                                <a href="https://soluxehotelmoscow.com/" target="_blank" class="circle-gr overflow-hidden relative bg-linear-(--white3-gr) py-1.5 px-7 flex items-center justify-center rounded-full before:bg-linear-(--white2-gr) before:p-0.5 before:rounded-full underline hover:no-underline hover:[&_span]:opacity-100">
                                    <span class="absolute inset-0 bg-linear-(--violet-gr) z-10 mix-blend-overlay opacity-0 transition-opacity"></span>
                                    Сайт
                                </a>
                                <a href="https://t.me/SoluxeHotelMoscow" target="_blank" class="circle-gr overflow-hidden relative bg-linear-(--white3-gr) py-1.5 px-7 flex items-center justify-center rounded-full before:bg-linear-(--white2-gr) before:p-0.5 before:rounded-full underline hover:no-underline hover:[&_span]:opacity-100">
                                    <span class="absolute inset-0 bg-linear-(--violet-gr) z-10 mix-blend-overlay opacity-0 transition-opacity"></span>
                                    Telegram
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative hidden lg:block relative flex-auto z-10">
                <div class="lg:absolute inset-0 mt-9 w-full h-full">
                    <img data-src="{{ 'storage/' . $block->payload['pic-main'] }}" alt="Отель" width="608" height="493" class="lazy">
                    <a href="tel:74951392020" class="absolute left-20 bottom-15">+7 495 139 20 20</a>
                </div>
            </div>
        </div>
    </div>
</section>
