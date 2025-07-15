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
                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::HERO
                    ),

                Forms\Components\Section::make([
                    Forms\Components\RichEditor::make('payload.text')
                        ->label('Текст'),
                    Forms\Components\TextInput::make('payload.name')
                        ->label('Имя')
                        ->default('Анна Кочкина')
                        ->columnSpan('full'),
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

                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::PROGRAMM
                    ),

                Forms\Components\Section::make([
                    Forms\Components\Section::make([
                        Forms\Components\RichEditor::make('payload.tariff-1')
                            ->label('Что включено')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.text-1')
                            ->label('Доп. текст')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.price-1')
                            ->label('Цена')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.old_price-1')
                            ->label('Старая цена')
                            ->columnSpan('full'),
                    ])->columnSpan(1),
                    Forms\Components\Section::make([
                        Forms\Components\RichEditor::make('payload.tariff-2')
                            ->label('Что включено')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.text-2')
                            ->label('Доп. текст')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.price-2')
                            ->label('Цена')
                            ->columnSpan('full'),
                        Forms\Components\TextInput::make('payload.old_price-2')
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
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
