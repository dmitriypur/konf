@switch($block->type)
    @case(\App\Enums\BlockType::HERO)
        <x-block.hero :block="$block"/>
        @break

    @case(\App\Enums\BlockType::ABOUT)
        <x-block.about :block="$block"/>
        @break
    @case(\App\Enums\BlockType::THEMES)
        <x-block.themes :block="$block"/>
        @break
    @case(\App\Enums\BlockType::PROGRAMM)
        <x-block.programm :block="$block"/>
        @break
    @case(\App\Enums\BlockType::CALL_TO_ACTION)
        <x-block.call-to-action :block="$block"/>
        @break
    @case(\App\Enums\BlockType::TARIFFS)
        <x-block.tariffs :block="$block"/>
        @break
    @case(\App\Enums\BlockType::PARTHNERS)
        <x-block.partners :block="$block"/>
        @break
    @case(\App\Enums\BlockType::LOCATION)
        <x-block.location :block="$block"/>
        @break
    @case(\App\Enums\BlockType::HOW_IT_WAS)
        <x-block.how-it-was :block="$block"/>
        @break

@endswitch
