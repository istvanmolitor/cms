<?php

declare(strict_types=1);

namespace Molitor\Cms\Filament\Resources\MenuResource\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Molitor\Cms\Models\MenuItem;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public static function getTitle(\Illuminate\Database\Eloquent\Model $ownerRecord, string $pageClass): string
    {
        return __('Menu Items');
    }

    public static function schema(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Components\TextInput::make('label')
                    ->label(__('Label'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('url')
                    ->label(__('URL'))
                    ->required()
                    ->maxLength(255)
                    ->placeholder('/about')
                    ->helperText(__('Internal path (e.g. /about) or external URL (e.g. https://example.com)')),

                Forms\Components\Select::make('parent_id')
                    ->label(__('Parent Item'))
                    ->options(function (RelationManager $livewire) {
                        return MenuItem::where('menu_id', $livewire->getOwnerRecord()->id)
                            ->whereNull('parent_id')
                            ->pluck('label', 'id');
                    })
                    ->nullable()
                    ->searchable()
                    ->helperText(__('Leave empty for top-level items')),

                Forms\Components\Toggle::make('is_external')
                    ->label(__('External Link'))
                    ->default(false)
                    ->helperText(__('Opens in new tab')),

                Forms\Components\TextInput::make('icon')
                    ->label(__('Icon'))
                    ->maxLength(255)
                    ->placeholder('heroicon-o-home')
                    ->helperText(__('Optional icon class')),

                Forms\Components\TextInput::make('sort')
                    ->label(__('Sort Order'))
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label(__('Label'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('url')
                    ->label(__('URL'))
                    ->searchable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('parent.label')
                    ->label(__('Parent'))
                    ->sortable()
                    ->default('-'),

                Tables\Columns\IconColumn::make('is_external')
                    ->label(__('External'))
                    ->boolean(),

                Tables\Columns\TextColumn::make('sort')
                    ->label(__('Sort'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('children_count')
                    ->label(__('Children'))
                    ->counts('children')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label(__('Level'))
                    ->options([
                        'null' => __('Top Level'),
                        'not_null' => __('Sub Items'),
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value'] === 'null') {
                            return $query->whereNull('parent_id');
                        } elseif ($data['value'] === 'not_null') {
                            return $query->whereNotNull('parent_id');
                        }
                        return $query;
                    }),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                DeleteBulkAction::make(),
            ])
            ->defaultSort('sort', 'asc')
            ->reorderable('sort');
    }
}

