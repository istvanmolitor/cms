<?php

namespace Molitor\Cms\Filament\Resources;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;
use Molitor\Cms\Filament\Resources\MenuItemResource\Pages;
use Molitor\Cms\Models\MenuItem;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static \BackedEnum|null|string $navigationIcon = 'heroicon-o-list-bullet';

    protected static ?int $navigationSort = 2;

    public static function getNavigationGroup(): string
    {
        return __('CMS');
    }

    public static function getNavigationLabel(): string
    {
        return __('Menu Items');
    }

    public static function getModelLabel(): string
    {
        return __('Menu Item');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Menu Items');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->columns(2)
            ->components([
                Forms\Components\Select::make('menu_id')
                    ->label(__('Menu'))
                    ->relationship('menu', 'name')
                    ->required()
                    ->searchable()
                    ->preload()
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('label')
                    ->label(__('Label'))
                    ->required()
                    ->maxLength(255)
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('url')
                    ->label(__('URL'))
                    ->required()
                    ->maxLength(255)
                    ->placeholder('/path/to/page')
                    ->columnSpanFull(),

                Forms\Components\Select::make('parent_id')
                    ->label(__('Parent Item'))
                    ->relationship(
                        name: 'parent',
                        titleAttribute: 'label',
                        modifyQueryUsing: fn (Builder $query, ?array $data) =>
                            isset($data['menu_id'])
                                ? $query->where('menu_id', $data['menu_id'])
                                : $query
                    )
                    ->searchable()
                    ->preload()
                    ->nullable()
                    ->helperText(__('Leave empty for a top-level menu item'))
                    ->columnSpanFull(),

                Forms\Components\TextInput::make('sort')
                    ->label(__('Sort Order'))
                    ->numeric()
                    ->default(0)
                    ->required(),

                Forms\Components\Toggle::make('is_external')
                    ->label(__('External Link'))
                    ->default(false)
                    ->helperText(__('Whether this link points to an external website')),

                Forms\Components\TextInput::make('icon')
                    ->label(__('Icon'))
                    ->maxLength(255)
                    ->placeholder('heroicon-o-home')
                    ->helperText(__('Optional icon name (e.g., heroicon-o-home)'))
                    ->columnSpanFull(),
            ]);
    }

    protected static function getMenuItemLevel($item, $level = 0): int
    {
        if (!$item->parent_id) {
            return $level;
        }

        $parent = MenuItem::find($item->parent_id);

        if (!$parent) {
            return $level;
        }

        return static::getMenuItemLevel($parent, $level + 1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('menu.name')
                    ->label(__('Menu'))
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('label')
                    ->label(__('Label'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        $level = static::getMenuItemLevel($record);
                        $indent = str_repeat('—', $level);
                        return $level > 0
                            ? new HtmlString('<span class="text-gray-500">' . $indent . '</span> ' . e($record->label))
                            : $record->label;
                    }),

                Tables\Columns\TextColumn::make('url')
                    ->label(__('URL'))
                    ->searchable()
                    ->limit(50),

                Tables\Columns\IconColumn::make('is_external')
                    ->label(__('External'))
                    ->boolean()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('sort')
                    ->label(__('Sort'))
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('children_count')
                    ->label(__('Children'))
                    ->counts('children')
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label(__('Created at'))
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('menu_id')
                    ->label(__('Menu'))
                    ->relationship('menu', 'name')
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('parent_id')
                    ->label(__('Level'))
                    ->options([
                        'null' => __('Top Level'),
                        'has_parent' => __('Has Parent'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return match ($data['value'] ?? null) {
                            'null' => $query->whereNull('parent_id'),
                            'has_parent' => $query->whereNotNull('parent_id'),
                            default => $query,
                        };
                    }),

                Tables\Filters\TernaryFilter::make('is_external')
                    ->label(__('External Link')),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('menu_id', 'asc')
            ->reorderable('sort');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenuItems::route('/'),
            'create' => Pages\CreateMenuItem::route('/create'),
            'edit' => Pages\EditMenuItem::route('/{record}/edit'),
        ];
    }
}

