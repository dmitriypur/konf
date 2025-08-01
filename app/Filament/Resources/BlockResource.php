<?php

namespace App\Filament\Resources;

use App\Enums\BlockType;
use App\Filament\Resources\BlockResource\Pages;
use App\Filament\Resources\BlockResource\RelationManagers;
use App\Models\Block;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlockResource extends Resource
{
    protected static ?string $model = Block::class;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $label = 'Блок';

    protected static ?string $pluralLabel = 'Блоки';

    protected static ?string $navigationIcon = 'heroicon-s-cube';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Заголовок')
                        ->columnSpan('full')
                        ->required(),

                    Forms\Components\Toggle::make('settings.title_hidden')
                        ->columnSpanFull()
                        ->label('Не отображать заголовок')
                        ->afterStateUpdated(
                            fn(Forms\Set $set, bool $state) => $set(
                                'settings.show_page_title',
                                false
                            )
                        )
                        ->reactive(),

                    Forms\Components\TextInput::make('anchor')
                        ->label('Идентификатор (якорь)')
                        ->prefix('#'),

                    Forms\Components\Select::make('page_id')
                        ->label('Страница')
                        ->required()
                        ->relationship('page', 'title', fn($query) => $query->orderBy('id')),

                    Forms\Components\Select::make('type')
                        ->columnSpanFull()
                        ->label('Тип')
                        ->options(BlockType::toArray())
                        ->default(BlockType::ABOUT->value)
                        ->reactive(),
                ]),

                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('payload.address')
                        ->label('Адрес'),
                    Forms\Components\DatePicker::make('payload.date')
                        ->label('Дата проведения'),
                    Forms\Components\Repeater::make('payload.list')
                        ->label('Элементы под заголовком')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Заголовок')
                                ->columnSpan('full')
                                ->required(),
                        ]),
                    Forms\Components\Repeater::make('payload.numbers')
                        ->label('Цифры')
                        ->schema([
                            Forms\Components\TextInput::make('number')
                                ->label('Цифра')
                                ->columnSpan('full'),
                            Forms\Components\TextInput::make('text')
                                ->label('Текст')
                                ->columnSpan('full'),
                        ]),
                    Forms\Components\Repeater::make('payload.advantages')
                        ->label('Преимущества внизу блока')
                        ->schema([
                            Forms\Components\TextInput::make('text')
                                ->label('Текст')
                                ->columnSpan('full'),
                            Forms\Components\FileUpload::make('icon')
                                ->label('Иконка')
                                ->directory('icons')
                                ->columnSpan('full'),
                        ]),
                    Forms\Components\Toggle::make('payload.btn-speaker')
                        ->label('Кнопка "Стать спикером"')
                        ->columnSpan('full'),
                    Forms\Components\Toggle::make('payload.btn-partner')
                        ->label('Кнопка "Стать партнером"')
                        ->columnSpan('full'),
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::HERO
                    ),

                Forms\Components\Section::make([
                    Forms\Components\RichEditor::make('payload.text')
                        ->label('Текст'),
                    Forms\Components\Repeater::make('payload.speackers')
                        ->label('Спикеры')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Имя спикера')
                                ->columnSpan('full'),
                            Forms\Components\RichEditor::make('info')
                                ->label('Информация о спикере')
                                ->columnSpan('full'),
                            Forms\Components\FileUpload::make('image')
                                ->label('Фото спикера')
                                ->directory('speackers')
                                ->columnSpan('full'),
                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::ABOUT
                    ),

                Forms\Components\Section::make([
                    Forms\Components\Toggle::make('payload.is_visible')
                        ->label("Показывать")
                        ->default(true),
                    Forms\Components\Repeater::make('payload.speackers')
                        ->label('Спикеры')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Имя спикера')
                                ->columnSpan('full'),
                            Forms\Components\TextInput::make('subtitle')
                                ->label('Подзаголовок')
                                ->columnSpan('full'),
                            Forms\Components\RichEditor::make('info')
                                ->label('Информация о спикере')
                                ->columnSpan('full'),
                            Forms\Components\FileUpload::make('image')
                                ->label('Фото спикера')
                                ->directory('speackers')
                                ->columnSpan('full'),
                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::SPEAKERS
                    ),

                Forms\Components\Section::make([
                    Forms\Components\Repeater::make('payload.themes')
                        ->label('Темы')
                        ->schema([
                            Forms\Components\FileUpload::make('icon')
                                ->label('Иконка')
                                ->directory('icons')
                                ->columnSpan('full'),
                            Forms\Components\TextInput::make('title')
                                ->label('Заголовок')
                                ->columnSpan('full'),
                            Forms\Components\Textarea::make('text')
                                ->label('Текст')
                                ->columnSpan('full'),

                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::THEMES
                    ),

                Forms\Components\Section::make([
                    Forms\Components\FileUpload::make('payload.link_programm')
                        ->label('Загрузить прогрумму')
                        ->directory('programm')
                        ->columnSpan('full'),
                    Forms\Components\Repeater::make('payload.programm')
                        ->label('Программа')
                        ->schema([
                            Forms\Components\TextInput::make('title')
                                ->label('Название')
                                ->columnSpan('full'),
                            Forms\Components\TextInput::make('time')
                                ->label('Время')
                                ->columnSpan('full'),
                            Forms\Components\Textarea::make('text')
                                ->label('Описание')
                                ->columnSpan('full'),
                            Forms\Components\Repeater::make('themes')
                                ->label('Темы')->schema([
                                    Forms\Components\TextInput::make('title')
                                        ->label('Тема')
                                        ->columnSpan('full'),
                                    Forms\Components\Textarea::make('text')
                                        ->label('Описание')
                                        ->columnSpan('full'),
                                    Forms\Components\Repeater::make('speakers')
                                        ->label('Спикеры')->schema([
                                            Forms\Components\TextInput::make('name')
                                                ->label('Имя спикера')
                                                ->columnSpan('full'),
                                            Forms\Components\FileUpload::make('photo')
                                                ->label('Фото спикера')
                                                ->directory('speackers')
                                                ->columnSpan('full'),
                                        ])
                                ])

                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::PROGRAMM
                    ),

                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('payload.subtitle')
                        ->label('Подзаголовок')
                        ->columnSpan('full'),
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::CALL_TO_ACTION
                    ),

                Forms\Components\Section::make([
                    Forms\Components\Section::make([
                        Forms\Components\Repeater::make('payload.tariff_1')
                            ->label('Что включено')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Название')
                                    ->columnSpan('full'),
                            ]),
                        Forms\Components\TextInput::make('payload.text_1')
                            ->label('Доп. текст')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.price_1')
                            ->label('Цена')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.old_price_1')
                            ->label('Старая цена')
                            ->columnSpan('full'),
                    ])->columnSpan(1),
                    Forms\Components\Section::make([
                        Forms\Components\Repeater::make('payload.tariff_2')
                            ->label('Что включено')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label('Название')
                                    ->columnSpan('full'),
                            ]),
                        Forms\Components\TextInput::make('payload.text_2')
                            ->label('Доп. текст')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.price_2')
                            ->label('Цена')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.old_price_2')
                            ->label('Старая цена')
                            ->columnSpan('full'),
                    ])->columnSpan(1),
                ])
                    ->columns(2)
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::TARIFFS
                    ),

                Forms\Components\Section::make([
                    Forms\Components\FileUpload::make('payload.video_cover')
                        ->label('Обложка видео')
                        ->directory('images')
                        ->columnSpan('full'),
                    Forms\Components\FileUpload::make('payload.video')
                        ->label('Видео')
                        ->directory('files')
                        ->acceptedFileTypes(['video/mp4'])
                        ->maxSize(102400) // 100 МБ
                        ->columnSpan('full'),
                    Forms\Components\Repeater::make('payload.reviews')
                        ->label('Отзывы')
                        ->schema([
                            Forms\Components\TextInput::make('name')
                                ->label('Имя')
                                ->columnSpan('full'),
                            Forms\Components\Textarea::make('text')
                                ->label('Текст')
                                ->columnSpan('full'),
                        ]),
                    Forms\Components\Repeater::make('payload.gallery')
                        ->label('Галерея')
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label('Фото')
                                ->columnSpan('full'),
                        ]),
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::HOW_IT_WAS
                    ),

                Forms\Components\Section::make([
                    Forms\Components\TextInput::make('payload.name_hotel')
                        ->label('Название отеля')
                        ->columnSpan('full'),
                    Forms\Components\TextInput::make('payload.address')
                        ->label('Адрес')
                        ->columnSpan('full'),
                    Forms\Components\FileUpload::make('payload.pic-1')
                        ->label('Фото 1')
                        ->directory('images')
                        ->columnSpan('full'),
                    Forms\Components\FileUpload::make('payload.pic-2')
                        ->label('Фото 2')
                        ->directory('images')
                        ->columnSpan('full'),
                    Forms\Components\FileUpload::make('payload.pic-main')
                        ->label('Основное фото')
                        ->directory('images')
                        ->columnSpan('full'),
                    Forms\Components\FileUpload::make('payload.pic-main-mobile')
                        ->label('Основное фото мобильный')
                        ->directory('images')
                        ->columnSpan('full'),
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::LOCATION
                    ),


                Forms\Components\Section::make([
                    Forms\Components\Repeater::make('payload.partners')
                        ->label('Партнеры')
                        ->schema([
                            Forms\Components\FileUpload::make('image')
                                ->label('Лого партнера')
                                ->columnSpan('full'),
                            Forms\Components\TextInput::make('name')
                                ->label('Название партнера')
                                ->columnSpan('full'),
                            Forms\Components\Checkbox::make('button')
                                ->label('Кнопка "Стать партнером"')
                                ->columnSpan('full'),
                        ]),
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::PARTHNERS
                    ),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')->label('Заголовок'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBlocks::route('/'),
            'create' => Pages\CreateBlock::route('/create'),
            'edit' => Pages\EditBlock::route('/{record}/edit'),
        ];
    }
}
