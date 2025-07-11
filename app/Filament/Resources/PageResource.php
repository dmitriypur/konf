<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Страницы';

    protected static ?string $slug = 'pages';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Forms\Components\TextInput::make('title')
                        ->label('Заголовок')
                        ->required(),
                    Forms\Components\Checkbox::make('active')
                        ->label('Опубликована'),

                ]),
                Section::make('SEO')->schema([
                    Forms\Components\TextInput::make('seo.title'),

                    Forms\Components\TextInput::make('seo.canonical')
                        ->label('Канонический URL')
                        ->prefix(config('app.url') . '/'),

                    Forms\Components\Textarea::make('seo.description')
                        ->helperText(function (?string $state): string {
                            return (string)Str::of(strlen($state))
                                ->append(' / ')
                                ->append(160 . ' ')
                                ->append('символов');
                        })
                        ->reactive(),

                    Forms\Components\Checkbox::make('seo.noindex')
                        ->label('Запретить поисковикам индексировать эту страницу'),
                ]),
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
            RelationManagers\BlocksRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
