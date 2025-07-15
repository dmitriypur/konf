<div class="swiper gallery w-full h-64">
    <div class="swiper-wrapper">
        @foreach($gallery as $item)
            <div class="swiper-slide">
                <div class="circle-gr relative w-full h-full p-1 rounded-3xl bg-linear-(--violet3-gr) before:rounded-3xl before:bg-linear-(--white3-gr) before:p-1 before:mix-blend-overlay">
                    <img src="{{ 'storage/' . $item['image'] }}" alt="Слайд 1" class="w-full h-full object-contain rounded-3xl">
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Навигация -->
<div class="flex justify-center gap-10 mt-4">
    <div class="gallery-button-prev relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer">
        <x-icons.arrow-left></x-icons.arrow-left>
    </div>
    <div class="gallery-button-next relative bg-white/10 hover:bg-white/20 transition-colors inline-flex items-center justify-center w-9.5 h-9.5 rounded-full cursor-pointer rotate-180">
        <x-icons.arrow-left></x-icons.arrow-left>
    </div>
</div>
