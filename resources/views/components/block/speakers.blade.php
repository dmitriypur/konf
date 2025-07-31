<section class="relative py-8 {{ !$block->payload['is_visible'] ? 'hidden' : '' }}" id="partners">
    <div class="container mx-auto">
        <h2 class="text-5xl lg:text-[64px] text-center">{{ $block->title }}</h2>
        <div class="w-full lg:h-[295px] flex-initial mt-6 lg:mt-8 relative px-3 lg:p-0">
            <div class="swiper speakers w-full h-full !pt-10">
                <div class="swiper-wrapper">
                    @foreach($block->payload['speackers'] as $k => $item)
                        <div class="swiper-slide">
                            <div class="relative flex w-full h-full rounded-4xl backdrop-blur-md">
                                <div
                                    class="absolute inset-0 rounded-4xl circle-gr bg-linear-(--darkblue3-gr) before:absolute before:bg-linear-(--violet-gr) before:p-0.5 before:rounded-4xl before:-z-10 -z-10"></div>
                                <div class="overflow-hidden lg:overflow-visible rounded-4xl w-full max-w-[130px] h-[180px] lg:h-auto lg:min-w-48 relative" data-da=".header-info-{{$k}},1024,0">
                                    <div
                                        class="lg:hidden absolute inset-0 rounded-4xl circle-gr before:absolute before:opacity-70 before:bg-linear-(--white2-gr) before:p-1 before:rounded-4xl before:-z-10 z-10"></div>
                                    <img data-src="{{ 'storage/' . $item['image'] }}" alt="{{ $item['name'] }}"
                                         class="lg:absolute left-0.5 bottom-0.5 w-full h-full lg:h-auto object-cover rounded-4xl">
                                </div>
                                <div class="p-3 lg:py-6 lg:px-1">
                                    <div class="header-info-{{$k}} flex items-center gap-2">
                                        <div>
                                            <p class="uppercase text-[28px]/7 font-bold">{{ $item['name'] }}</p>
                                            @if(!empty($item['subtitle']))
                                                <p class="text-sm/4 font-semibold mt-2">{{ $item['subtitle'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @if(!empty($item['info']))
                                        <div class="text-sm/4 p-2 lg:p-0 mt-2 [&_ul]:space-y-2 [&_li]:relative [&_li]:pl-3 [&_li]:before:absolute [&_li]:before:rounded-full [&_li]:before:bg-white [&_li]:before:w-1 [&_li]:before:h-1 [&_li]:before:left-0 [&_li]:before:top-2.5">{!! $item['info'] !!}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
        <div class="flex justify-center items-center gap-10 mt-8 lg:mt-15">
            <div
                class="speakers-button-prev inline-flex bg-white/10 hover:bg-white/20 transition-colors items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
                <x-icons.arrow-left></x-icons.arrow-left>
            </div>
            <div
                class="speakers-button-next inline-flex bg-white/10 hover:bg-white/20 transition-colors items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
                <x-icons.arrow-left></x-icons.arrow-left>
            </div>
        </div>
    </div>
</section>
