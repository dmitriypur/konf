<section class="relative py-8 lg:py-4">
    <div class="container mx-auto">
        <div class="px-8 lg:px-4">
            <h3 class="text-[38px]/8 lg:text-[40px]/10 mb-4">Ключевые темы</h3>

            <div class="swiper themes w-full h-auto">
                <div class="swiper-wrapper">
                    @foreach($block->payload['themes'] as $item)
                        <div class="swiper-slide !h-auto circle-gr flex flex-col bg-white/5 px-10 py-6 rounded-3xl before:rounded-3xl before:bg-linear-(--violet-gr) xl:before:bg-linear-(--white3-gr) before:p-[2px] lg:after:bg-linear-(--violet-gr) lg:after:rounded-3xl lg:after:p-[2px] lg:after:opacity-0 lg:hover:after:opacity-100 lg:hover:[&_span]:border-0 lg:hover:[&_span]:bg-linear-(--violet-gr) backdrop-blur-lg lg:transition-transform after:-z-10 before:-z-10">
                        <span class="inline-flex items-center justify-center w-17 h-17 rounded-full bg-linear-(--violet-gr) xl:bg-linear-(--white4-gr) border border-white/10 mr-5 transition-color">
                            <img data-src="{{ asset('storage/' . $item['icon']) }}" alt="{{ $item['title'] }}">
                        </span>
                            <p class="text-xl mt-10">{{ $item['title'] }}</p>
                            <div class="mt-7 text-white/60">
                                {{ $item['text'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <!-- Навигация -->
                <div class="flex justify-center gap-10 mt-8">
                    <div class="themes-button-prev relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
                        <x-icons.arrow-left></x-icons.arrow-left>
                    </div>
                    <div class="themes-button-next relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
                        <x-icons.arrow-left></x-icons.arrow-left>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
