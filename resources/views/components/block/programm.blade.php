<section class="relative pt-10 pb-20" id="programm">
    <div class="absolute opacity-50 lg:opacity-100 -rotate-130 lg:rotate-0 w-400 -left-180 -top-150 lg:left-1/2 lg:-translate-x-1/2 lg:-top-90 lg:w-550 h-auto -z-10">
        <img data-src="{{ asset('images/morph.webp') }}" alt="Разноцветное облако" width="2200" height="920"
             class="w-full">
    </div>
    <div class="container mx-auto px-3 lg:px-0">
        <h2 class="text-center text-5xl md:text-[64px]">программа</h2>
        <div class="swiper programm">
            <div class="swiper-wrapper before:content-none lg:before:content-[''] before:absolute before:w-full before:h-[1px] before:bg-white before:top-1/2 before:-translate-y-3 mt-15">
                @foreach($block->payload['programm'] as $item)
                    <div class="swiper-slide item__step w-full">
                        <div class="circle-gr relative bg-white/5 lg:bg-transparent rounded-4xl before:-z-10 after:-z-10 lg:before:hidden before:bg-linear-(--violet-gr) before:p-[1px] before:rounded-4xl ">
                            <h3 class="text-center text-2xl py-12 lg:py-0">
                            <span
                                class="lg:hidden title-circle inline-block relative -left-2 top-2 w-7.5 h-7.5 circle-gr bg-white before:bg-linear-(--violet-gr) rounded-full before:rounded-full before:p-1.5"></span>
                                <span class="inline-block">
                                {{ $item['title'] }}
                            </span>
                            </h3>
                            <div
                                class="hidden lg:block after__line relative mt-11 w-full h-12.5 border-x before:absolute before:bg-white before:w-[1px] before:h-1/2 before:left-1/2 before:top-0">
                            <span
                                class="block absolute left-1/2 -top-7.5 -translate-x-1/2 w-7.5 h-7.5 circle-gr before:bg-linear-(--white-gr) rounded-full before:rounded-full before:p-2 mix-blend-overlay"></span>
                            </div>
                            <div class="lg:hidden w-full h-[1px] bg-white"></div>
                            <div class="px-4 pb-10 pt-1 lg:p-0">
                                <div
                                    class="item__step-btn circle-gr overflow-hidden relative flex items-center justify-center h-12.5 rounded-full bg-linear-(--white2-gr) before:rounded-full before:p-0.5 before:bg-linear-(--white-gr) mt-1.5 lg:transition-shadow">
                            <span
                                class="absolute inset-0 bg-linear-(--violet-gr) -z-10 transition-opacity"></span>
                                    {{ $item['time'] }}
                                </div>
                                <p class="item__step--text item__step--text text-xs transition-colors duration-300 mt-2.5">
                                    {{ $item['text'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Навигация -->
            <div class="flex justify-center gap-10 mt-8">
                <div class="programm-button-prev relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
                    <x-icons.arrow-left></x-icons.arrow-left>
                </div>
                <div class="programm-button-next relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
                    <x-icons.arrow-left></x-icons.arrow-left>
                </div>
            </div>
        </div>
    </div>
</section>
