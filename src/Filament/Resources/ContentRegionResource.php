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

                Section::make(__('Content Boxes'))
                    ->schema([
                        Forms\Components\Repeater::make('contentBoxes')
                            ->relationship('contentBoxes')
                            ->label('')
                            ->schema([
                                Forms\Components\TextInput::make('title')
                                    ->label(__('Title'))
                                    ->required()
                                    ->maxLength(255)
                                    ->columnSpanFull(),

                                Forms\Components\Select::make('content_id')
                                    ->label(__('Content'))
                                    ->relationship('content', 'id')
                                    ->searchable()
                                    ->preload()
                                    ->required()
                                    ->createOptionForm([
                                        Forms\Components\Hidden::make('user_id')
                                            ->default(fn () => auth()->id()),
                                    ])
                                    ->columnSpan(1),

                                Forms\Components\Toggle::make('is_visible')
                                    ->label(__('Visible'))
                                    ->default(true)
                                    ->inline(false)
                                    ->columnSpan(1),

                                Forms\Components\TextInput::make('sort')
                                    ->label(__('Sort Order'))
                                    ->numeric()
                                    ->default(0)
                                    ->columnSpan(1),
                            ])
                            ->columns(3)
                            ->defaultItems(0)
                            ->reorderable(true)
                            ->reorderableWithButtons()
                            ->collapsible()
                            ->itemLabel(fn (array $state): ?string => $state['title'] ?? null)
                            ->addActionLabel(__('Add Content Box')),
                    ]),
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

                Tables\Columns\TextColumn::make('contentBoxes_count')
                    ->counts('contentBoxes')
                    ->label(__('Content Boxes'))
                    ->sortable(),

                Tables\Columns\TextColumn::make('visible_boxes_count')
                    ->label(__('Visible Boxes'))
                    ->getStateUsing(fn (ContentRegion $record): int =>
                        $record->contentBoxes()->where('is_visible', true)->count()
                    )
                    ->sortable(false),
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

