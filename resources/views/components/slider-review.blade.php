<div class="swiper reviews w-full h-64">
    <div class="swiper-wrapper h-full">
        @foreach($reviews as $item)
        <div class="swiper-slide h-full">
            <div class="circle-gr h-full relative w-full py-8 px-8 rounded-3xl bg-linear-(--violet3-gr) before:rounded-3xl before:bg-linear-(--white3-gr) before:p-1 before:mix-blend-overlay">
                <div class="flex items-center gap-6">
                    <span
                        class="inline-flex items-center justify-center w-11 h-11 min-w-11 [&_svg]:w-6 [&_svg]:h-6 rounded-full bg-white/5 border border-white/10">
                        <x-icons.user></x-icons.user>
                    </span>
                    <p class="text-base/5">{!! $item['name'] !!}</p>
                </div>
                <div class="mt-5 text-sm/5">
                {!! $item['text'] !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Навигация -->
<div class="flex justify-center gap-10 mt-4">
    <div class="reviews-button-prev relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
        <x-icons.arrow-left></x-icons.arrow-left>
    </div>
    <div class="reviews-button-next relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
        <x-icons.arrow-left></x-icons.arrow-left>
    </div>
</div>
