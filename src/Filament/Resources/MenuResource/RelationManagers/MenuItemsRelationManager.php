<?php

namespace Molitor\Cms\Filament\Resources\MenuResource\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\HtmlString;

class MenuItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Menu Items');
    }

    protected static ?string $recordTitleAttribute = 'label';

    protected function getMenuItemOptions($item, $prefix = ''): array
    {
        $options = [$item->id => $prefix . $item->label];

        foreach ($item->children()->orderBy('sort')->get() as $child) {
            $options = array_merge($options, $this->getMenuItemOptions($child, $prefix . '— '));
        }

        return $options;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                Forms\Components\TextInput::make('label')
                    ->label(__('Label'))
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('url')
                    ->label(__('URL'))
                    ->required()
                    ->maxLength(255)
                    ->placeholder('/path/to/page'),

                Forms\Components\Select::make('parent_id')
                    ->label(__('Parent Item'))
                    ->options(function () {
                        $menuId = $this->getOwnerRecord()->id;
                        return \Molitor\Cms\Models\MenuItem::where('menu_id', $menuId)
                            ->whereNull('parent_id')
                            ->get()
                            ->flatMap(function ($item) {
                                return $this->getMenuItemOptions($item);
                            })
                            ->toArray();
                    })
                    ->searchable()
                    ->nullable()
                    ->helperText(__('Leave empty for a top-level menu item')),

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
                    ->helperText(__('Optional icon name (e.g., heroicon-o-home)')),
            ]);
    }

    protected function getMenuItemLevel($item, $level = 0): int
    {
        if (!$item->parent_id) {
            return $level;
        }

        $parent = \Molitor\Cms\Models\MenuItem::find($item->parent_id);

        if (!$parent) {
            return $level;
        }

        return $this->getMenuItemLevel($parent, $level + 1);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->modifyQueryUsing(fn (Builder $query) => $query->orderBy('sort'))
            ->columns([
                Tables\Columns\TextColumn::make('label')
                    ->label(__('Label'))
                    ->searchable()
                    ->sortable()
                    ->formatStateUsing(function ($record) {
                        $level = $this->getMenuItemLevel($record);
                        $indent = str_repeat('—', $level);
                        return $level > 0 ? new HtmlString('<span class="text-gray-500">' . $indent . '</span> ' . e($record->label)) : $record->label;
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

                Tables\Columns\TextColumn::make('icon')
                    ->label(__('Icon'))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('children_count')
                    ->label(__('Children'))
                    ->counts('children')
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('parent_id')
                    ->label(__('Parent'))
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
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['menu_id'] = $this->getOwnerRecord()->id;
                        return $data;
                    }),
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
            ->reorderable('sort')
            ->defaultSort('sort', 'asc');
    }
}
