<?php

namespace App\Filament\Resources\PageResource\RelationManagers;

use App\Filament\Resources\BlockResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BlocksRelationManager extends RelationManager
{
    protected static string $relationship = 'blocks';
    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $modelLabel = 'Блок';

    protected static ?string $pluralModelLabel = 'Блоки';

    protected static ?string $title = 'Блоки';

    public function form(Form $form): Form
    {
        return app(BlockResource::class)->form($form);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                Tables\Columns\TextColumn::make('title'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->reorderable('order_column');;
    }
}
