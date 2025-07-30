<section class="relative pt-10 pb-10 lg:pb-0 z-0" id="programm">
    <div
        class="absolute opacity-50 lg:opacity-100 -rotate-130 lg:rotate-0 w-400 -left-180 lg:left-1/2 lg:-translate-x-1/2 lg:w-550 h-auto -z-10">
        <img data-src="{{ asset('images/morph.webp') }}" alt="Разноцветное облако" width="2200" height="920"
             class="w-full">
    </div>
    <div class="mx-auto relative z-10">
        <h2 class="text-center text-5xl md:text-[64px]">{{ $block->title }}</h2>
        <div class="w-full bg-[#0D1545] pt-24 md:pb-20 mt-5 relative -z-10">
            <div class="container mx-auto px-3 md:px-0 relative">
                <div class="relative programms grid lg:grid-cols-5 gap-20">
                    @foreach($block->payload['programm'] as $key => $item)
                        @if(empty($item['text']))
                            <div
                                class="programm__card relative mt-4 md:mt-0 lg:flex lg:flex-col {{ $key ? 'hidden' : '' }}">
                                @if($key !== (count($block->payload['programm']) - 1))
                                    <span
                                        class="pink-round block w-7.5 h-7.5 relative left-1/2 -top-9 -translate-x-1/2 rounded-full before:bg-linear-(--pink-gr) before:p-1.5 before:inset-0 before:rounded-full"></span>
                                @else
                                    <span
                                        class="pink-round block w-7.5 h-7.5 relative left-1/2 -top-9 -translate-x-1/2 rounded-full">
                                        <img src="{{ asset('images/coin.svg') }}" alt="Рубль">
                                    </span>
                                @endif
                                <div
                                    class="programms__item lg:grow lg:flex lg:flex-col relative overflow-hidden rounded-[20px] before:bg-linear-(--white3-gr) border {{ $key !== (count($block->payload['programm']) - 1) ? 'border-[#E972F5]' : 'border-[#FAA287]' }}">
                                    <p class="text-2xl p-4 lg:grow font-secondary text-center">{{ $item['title'] }}</p>
                                    <div class="time-block p-4">
                                        <div
                                            class="time-label max-w-40 mx-auto relative p-2.5 rounded-full text-center {{ $key !== (count($block->payload['programm']) - 1) ? 'bg-linear-(--pink5-gr) before:bg-linear-(--pink5-gr)' : 'bg-linear-(--brown-gr) before:bg-linear-(--brown-gr)' }}  before:p-0.5 before:rounded-full">{{ $item['time'] }}</div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="programm__card relative -top-4 lg:hidden {{ $key > 1 ? 'hidden' : '' }}">
                            <span
                                class="violet-round inverted block w-7.5 h-7.5 relative left-1/2 -top-6 -translate-x-1/2 rounded-full before:bg-linear-(--violet5-gr) before:p-1.5 before:inset-0 before:rounded-full"></span>
                                <div
                                    class="programms__item h-full relative rounded-[20px] before:rounded-[20px] before:bg-linear-(--white3-gr)">
                                    <p class="text-2xl p-4 font-secondary text-center">{{ $item['title'] }}</p>
                                    <div class="time-block-2 px-4 pb-4">
                                        <div
                                            class="relative p-2.5 rounded-full text-center bg-linear-(--violet5-gr)">{{ $item['time'] }}</div>
                                    </div>
                                    <div class="themes-block p-4 grid gap-3 text-sm">
                                        @if($item['themes'])
                                            @foreach($item['themes'] as $theme)
                                                <div class="dark-desctop-card inline-flex items-center gap-2 w-full">
                                                    <span class="w-6 h-auto overflow-hidden absolute"><img
                                                            src="{{ asset('images/theme-item.svg') }}"
                                                            alt="Разноцветная стрелка с кружком"
                                                            class="w-full h-auto relative -left-full"></span>
                                                    <div
                                                        class="theme-card w-full themes-block__card border border-white rounded-[20px] p-3 bg-linear-(--violet-gr)">
                                                        <div class="flex gap-5">
                                                            <div
                                                                class="flex items-end bg-white/40 overflow-hidden border border-white rounded-[10px] h-auto {{ count($theme['speakers']) > 1 ? 'min-w-[140px]' : 'min-w-[70px]' }}">
                                                                @foreach($theme['speakers'] as $speaker)
                                                                    <div
                                                                        class="relative h-[84px] w-[70px]">
                                                                        <img src="{{ '/storage/' . $speaker['photo'] }}"
                                                                             alt="{{ $speaker['name'] }}"
                                                                             class="w-full h-full object-cover">
                                                                        <div
                                                                            class="absolute left-0 bottom-0 w-full h-6 bg-linear-(--white-vertical3-gr) px-2 pt-1 text-[10px]/2 text-black">
                                                                            {!! $speaker['name'] !!}
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="space-y-2">
                                                                <div class="text-[14px]/4">
                                                                    Тема: {!! $theme['title'] !!}</div>
                                                                <div class="text-[10px]/3">{!! $theme['text'] !!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif

                    @endforeach

                </div>
                <div
                    class="hidden lg:block absolute lg:top-32 xl:top-24 overflow-hidden rounded-b-[20px] w-full h-32 border border-[#E972F5] before:absolute before:inset-0 before:bg-linear-(--darkblue2-gr) -z-10"></div>
                <div class="hidden lg:grid md:grid-cols-4 gap-10 lg:mt-12 xl:mt-18 px-4">
                    @foreach($block->payload['programm'] as $item)
                        @if(!empty($item['text']))
                            <div class="relative">
                            <span
                                class="violet-round block w-7.5 h-7.5 relative left-1/2 top-0 -translate-x-1/2 rounded-full before:bg-linear-(--violet5-gr) before:p-1.5 before:inset-0 before:rounded-full"></span>
                                <div
                                    class="programms__item h-full relative rounded-[20px] before:rounded-[20px] before:bg-linear-(--white3-gr)">
                                    <p class="text-2xl p-4 font-secondary text-center">{{ $item['title'] }}</p>
                                    <div class="time-block-2 px-4 pb-4">
                                        <div
                                            class="relative p-2.5 rounded-full text-center bg-linear-(--violet5-gr)">{{ $item['time'] }}</div>
                                    </div>
                                    <div class="themes-block p-4 grid gap-3 text-sm">
                                        @if($item['themes'])
                                            @foreach($item['themes'] as $theme)
                                                <div class="dark-desctop-card inline-flex items-center gap-2">
                                                    <span class="w-6 h-auto overflow-hidden absolute"><img
                                                            src="{{ asset('images/theme-item.svg') }}"
                                                            alt="Разноцветная стрелка с кружком"
                                                            class="w-full h-auto relative -left-full"></span>
                                                    <p class="">
                                                        {!! $theme['title'] !!}</p>
                                                    <div
                                                        class="theme-card invisible opacity-0 absolute -bottom-24 w-[360px] themes-block__card border border-white rounded-[20px] p-4 bg-linear-(--violet-gr) z-10">
                                                        <div class="flex gap-5">
                                                            <div
                                                                class="flex items-end bg-white/40 overflow-hidden border border-white rounded-[10px] h-auto {{ count($theme['speakers']) > 1 ? 'min-w-[152px]' : 'min-w-[76px]' }}">
                                                                @foreach($theme['speakers'] as $speaker)
                                                                    <div
                                                                        class="relative h-[90px] w-[76px]">
                                                                        <img src="{{ '/storage/' . $speaker['photo'] }}"
                                                                             alt="{{ $speaker['name'] }}"
                                                                             class="w-full h-full object-cover">
                                                                        <div
                                                                            class="absolute left-0 bottom-0 w-full h-6 bg-linear-(--white-vertical3-gr) px-2 pt-1 text-[10px]/2 text-black">
                                                                            {!! $speaker['name'] !!}
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                            <div class="space-y-2">
                                                                <div class="text-[14px]/4">
                                                                    Тема: {!! $theme['title'] !!}</div>
                                                                <div class="text-[10px]/3">{!! $theme['text'] !!}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <button id="open-programms" type="button"
                        class="flex items-center justify-center mx-auto mt-16 font-secondary text-xl lg:text-2xl w-full h-16 lg:h-20 bg-linear-(--white2-gr) rounded-full border border-white/40 backdrop-blur-md lg:hidden">
                    открыть полностью
                </button>
                @if(!empty($block->payload['link_programm']))
                    <a href="{{ 'storage/' . $block->payload['link_programm'] }}" target="_blank"
                       class="flex items-center justify-center mx-auto mt-10 md:mt-20 font-secondary text-xl lg:text-2xl max-w-[500px] h-16 lg:h-20 bg-linear-(--violet-gr) lg:bg-linear-(--white2-gr) rounded-full border border-white/40 backdrop-blur-md lg:hover:shadow-[0_0_35px_rgba(225,225,225,0.5)] lg:transition-shadow">скачать
                        программу в PDF</a>
                @endif
            </div>

        </div>
    </div>
</section>
