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
                        ])
                ])
                    ->hidden(
                        fn(Forms\Get $get) => BlockType::from($get('type')) !=
                            BlockType::HERO
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
