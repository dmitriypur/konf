<section class="relative py-8" id="how-it-was">
    <div class="container mx-auto">
        <h2 class="text-[40px]/10 text-center lg:text-[64px]">{{ $block->title ?? '' }}</h2>
        <div class="flex flex-col lg:flex-row items-center my-6 lg:my-16 px-3 lg:px-0">
            <div class="relative">
                <div
                    class="overflow-hidden rounded-4xl circle-gr before:bg-linear-(--white2-gr) before:p-1.5 before:rounded-4xl after:-z-10">
                    <img data-src="storage/{{ $block->payload['video_cover'] ?? asset('images/video-cover.webp') }}" alt="{{ $block->title ?? '' }}" width="618"
                         height="363" class="lazy">
                </div>
                <button type="button"
                        data-modal-target="video"
                        data-video="{{ !empty($block->payload['video']) ? 'storage/' . $block->payload['video'] : asset('files/video.mp4') }}"
                        class="open-modal-btn max-w-[320px] absolute overflow-hidden right-1/2 translate-x-1/2 lg:-right-12 -bottom-8 flex items-center gap-2 circle-gr bg-linear-(--white2-gr) py-6 px-8 lg:py-11 lg:px-12 lg:text-2xl text-left rounded-2xl lg:rounded-4xl backdrop-blur-xl cursor-pointer hover:[&_.span-bg]:opacity-100 after:-z-10 before:-z-10">
                    Смотреть видео
                    <span
                        class="span-bg absolute inset-0 -z-10 bg-linear-(--violet-gr) opacity-0 transition-opacity"></span>
                    <span
                        class="flex items-center justify-center min-w-9.5 w-9.5 h-9.5 lg:min-w-13.5 lg:w-13.5 lg:h-13.5 rounded-full bg-linear-(--white3-gr) border border-white/20">
                        <x-icons.arrow-diagonal></x-icons.arrow-diagonal>
                    </span>
                </button>
            </div>
            <div class="lg:ml-auto w-full lg:max-w-96 mt-20 lg:mt-0">
                <div class="relative w-full h-full rounded-4xl overflow-hidden pb-5 before:absolute before:inset-0 before:backdrop-blur-md before:-z-10">
                    <div class="absolute w-120 h-120 left-1/2 -translate-x-1/2 -top-5 -z-10">
                        <img data-src="{{ asset('images/bg-tabs-slider.svg') }}" class="lazy" alt="Цветное облако фоновое изображение" width="580" height="580">
                    </div>
                    <span class="absolute inset-0 -z-10 bg-linear-(--white3-gr) mix-blend-overlay"></span>
                    <div class="py-5 px-13.5 backdrop-blur-md">
                        <div class="flex items-center justify-between">
                            <button data-tab="tab1" class="tab-button cursor-pointer text-white hover:text-white">Отзывы</button>
                            <span class="block h-[1px] w-10 rotate-90 bg-linear-(--white-vertical2-gr)"></span>
                            <button data-tab="tab2" class="tab-button cursor-pointer text-white/60 hover:text-white">Галерея</button>
                        </div>
                    </div>
                    <div id="tab1" class="tab-content">
                        @if(!empty($block->payload['reviews']))
                        <x-slider-review :reviews="$block->payload['reviews']"></x-slider-review>
                        @endif
                    </div>

                    <div id="tab2" class="tab-content hidden">
                        @if(!empty($block->payload['gallery']))
                        <x-slider-gallery :gallery="$block->payload['gallery']"></x-slider-gallery>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
