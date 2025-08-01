<section class="relative py-8" id="partners" id="partners">
    <div class="lg:hidden absolute -left-30 -top-40 w-180 -z-10">
        <img data-src="{{ asset('images/bg-mobile-partner.webp') }}" alt="Фоновое изображение разноцветное облако" width="720" height="1047">
    </div>
    <div class="container mx-auto">
        <div class="max-w-270 mx-auto">
            <h2 class="text-5xl md:text-[64px] text-center">{{ $block->title }}</h2>
            <div class="w-full h-auto flex-initial mt-6 lg:mt-8 px-18 lg:px-23 relative">
                <div class="swiper partners w-full h-auto">
                    <div class="swiper-wrapper flex-col gap-5 lg:gap-0 lg:flex-row">
                        @foreach($block->payload['partners'] as $item)
                            @if(!$item['button'])
                                <div class="swiper-slide backdrop-blur-md">
                                    <div class="circle-gr relative bg-white/5 w-full h-full rounded-3xl p-5 before:absolute before:bg-linear-(--violet-gr) before:p-0.5 before:rounded-3xl before:-z-10">
                                        <div class="flex items-center justify-center w-full h-29.5">
                                            <img data-src="{{ 'storage/' . $item['image'] }}" alt="{{ $item['name'] }}">
                                        </div>
                                        <div class="mt-5 relative circle-gr w-full h-15 flex items-center justify-center rounded-full text-sm/4 text-center tracking-tight bg-linear-(--violet-gr) before:absolute before:bg-linear-(--white3-gr) before:p-0.5 before:rounded-3xl before:rounded-full before:mix-blend-overlay">
                                            <span class="relative z-10">{!! $item['name'] !!}</span>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="swiper-slide backdrop-blur-md">
                                    <div class="circle-gr relative bg-white/5 w-full h-full rounded-3xl p-5 before:absolute before:bg-linear-(--violet-gr) before:p-0.5 before:rounded-3xl before:-z-10 after:-z-10">
                                        <div class="flex items-center justify-center w-full h-29.5 circle-gr relative rounded-3xl p-5 before:absolute before:bg-linear-(--violet-gr) before:p-[1px] before:rounded-3xl before:-z-10">
                                            <span class="absolute inset-0 bg-linear-(--white3-gr) rounded-3xl -z-10 opacity-30"></span>
                                            <img data-src="{{ asset('images/question-mark.svg') }}" alt="Иконка знак вопроса">
                                        </div>
                                        <div data-modal-target="form2" class="open-modal-btn cursor-pointer mt-5 relative circle-gr w-full h-15 flex items-center justify-center rounded-full text-sm/4 text-center tracking-tight bg-linear-(--violet-gr) before:absolute before:bg-linear-(--white3-gr) before:p-0.5 before:rounded-3xl before:rounded-full before:mix-blend-overlay after:-z-10 before:-z-10">
                                            <span class="relative z-10">Стать партнером</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div class="partners-button-prev hidden lg:inline-flex lg:absolute left-0 top-1/2 lg:-translate-y-1/2 z-10 bg-white/10 hover:bg-white/20 transition-colors items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
                    <x-icons.arrow-left></x-icons.arrow-left>
                </div>
                <div class="partners-button-next hidden lg:inline-flex lg:absolute right-0 top-1/2 lg:-translate-y-1/2 z-10 bg-white/10 hover:bg-white/20 transition-colors items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
                    <x-icons.arrow-left></x-icons.arrow-left>
                </div>


            </div>
        </div>
    </div>
</section>
