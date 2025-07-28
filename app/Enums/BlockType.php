<?php

namespace App\Enums;

enum BlockType: int
{
    case HERO = 0;
    case ABOUT = 1;
    case PROGRAMM = 2;
    case CALL_TO_ACTION = 3;
    case TARIFFS = 4;
    case PARTHNERS = 5;
    case LOCATION = 6;
    case HOW_IT_WAS = 7;
    case THEMES = 8;
    case SPEAKERS = 9;

    public function getLabel(): string
    {
        return match ($this) {
            self::HERO => 'Главный экран (1й)',
            self::ABOUT => 'О конференции',
            self::PROGRAMM => 'Программа',
            self::CALL_TO_ACTION => 'Форма заявки',
            self::TARIFFS => 'Тарифы',
            self::PARTHNERS => 'Партнеры',
            self::LOCATION => 'Место проведения',
            self::HOW_IT_WAS => 'Как это было',
            self::THEMES => 'Темы',
            self::SPEAKERS => 'Спикеры',
        };
    }

    public static function toArray(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn($value) => [$value->value => $value->getLabel()])
            ->sort()
            ->toArray();
    }
}
