<?php

namespace Molitor\Cms\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Molitor\Cms\Filament\Forms\Components\ContentEditor;
use Molitor\Cms\Models\ContentRegion;

class ContentRegionResource extends Resource
{
    protected static ?string $model = ContentRegion::class;

    protected static \BackedEnum|null|string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): string
    {
        return __('CMS');
    }

    public static function getNavigationLabel(): string
    {
        return __('Content Regions');
    }

    public static function getModelLabel(): string
    {
        return __('Content Region');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Content Regions');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(1)
            ->components([
                Forms\Components\TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                ContentEditor::make('content.contentElements'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label(__('ID'))
                    ->sortable()
                    ->searchable(),

                Tables\Columns\TextColumn::make('name')
                    ->label(__('Name'))
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('name', 'asc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ContentRegionResource\Pages\ListContentRegions::route('/'),
            'create' => ContentRegionResource\Pages\CreateContentRegion::route('/create'),
            'edit' => ContentRegionResource\Pages\EditContentRegion::route('/{record}/edit'),
        ];
    }
}

