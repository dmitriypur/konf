<section id="speackers" class="relative z-10 md:z-0 pb-10">
    <div class="container mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-4 items-end relative">
            <div class="absolute left-100 -top-50 w-150 h-150 rounded-full bg-purple blur-[150px] -z-10"></div>
            <div class="absolute left-80 top-30 w-100 h-100 rounded-full bg-my-dark-blue blur-[150px] -z-10"></div>
            <div class="w-full">
                <h2 class="font-secondary text-center md:text-left text-5xl md:text-[64px]">{{ $block->title }}</h2>
                <div class="text-sm/5 italic -ml-1 -mr-1 lg:ml-0 lg:mr-0 mt-6 circle-gr relative py-7 px-3 lg:px-10 bg-white/5 md:rounded-3xl before:absolute before:bg-linear-(--violet-gr) before:p-0.5 md:before:rounded-3xl before:-z-10 backdrop-blur-lg">
                    {!! $block->payload['text'] !!}
                </div>
            </div>
            <div class="relative">
                <span class="hidden lg:block absolute right-0 -top-full translate-y-full">
                    <img data-src="{{ asset('images/speackers-icon.webp') }}" alt="Иконка сообщение, лайк, пользователь" width="107" height="73" class="lazy">
                </span>
                <div class="lg:w-full lg:h-full lg:flex-initial lg:pl-16 lg:relative mt-8 md:mt-0">
                    <!-- Контейнер -->
                    @foreach($block->payload['speackers'] as $item)
                        <div class="relative circle-gr w-full h-full bg-linear-(--white2-gr) before:bg-linear-(--violet-gr) rounded-4xl before:rounded-4xl before:p-1 before:-z-10 flex items-center after:-z-10 before:mix-blend-overlay">
                            <div class="absolute inset-0 overflow-hidden rounded-4xl mix-blend-overlay">
                                <div class="absolute w-200 h-127 left-1/2 top-1/2 -translate-y-2/4 -translate-x-2/5 -z-10">
                                    <img data-src="{{ asset('images/bg-slide-speacker.webp') }}" alt="Фон карточки спикера" width="1080" height="668" class="w-full h-full lazy">
                                </div>
                            </div>

                            <img data-src="{{ asset('images/logo-transparent.svg') }}" alt="Логотип прозрачный" width="87" height="85" class="absolute bottom-5 right-7 lazy">
                            <div class="relative circle-gr md:static z-10 overflow-hidden w-full max-w-29 lg:max-w-37 h-full before:max-w-29 lg:before:max-w-37 before:bg-linear-(--violet3-gr) rounded-4xl before:rounded-4xl before:p-2 before:mix-blend-overlay after:-z-10 md:before:opacity-0">
                                <img data-src="{{ asset('storage/' . $item['image']) }}" alt="{{ $item['name'] }}" class="md:absolute left-0 bottom-0">
                            </div>
                            <div class="py-4 px-6 relative z-10">
                                <p class="text-2xl xl:text-[32px] font-bold uppercase">{{ $item['name'] }}</p>
                                <div class="text-xs xl:text-[15px]/4.5 mt-2 [&_p]:mb-2 [&_b]:block">
                                    {!! $item['info'] !!}
                                </div>
                                <div class="mt-1 hidden">
                                    <div class="circle-gr relative bg-linear-(--violet-gr) before:bg-linear-(--violet-gr) before:p-[1.5px] rounded-lg before:rounded-lg py-1 px-3 font-secondary text-xl z-20">тема:</div>
                                    <div class="circle-gr relative -top-1.5 bg-linear-(--white2-gr) before:bg-linear-(--white2-gr) before:p-[1.5px] rounded-b-lg before:rounded-b-lg p-3 text-[10px] italic mix-blend-overlay">“Тренды медицинского рынка 2025.”</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
