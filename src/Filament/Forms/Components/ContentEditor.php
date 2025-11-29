<?php

namespace Molitor\Cms\Filament\Forms\Components;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;

class ContentEditor
{
    public static function make(string $name = 'contentElements'): Repeater
    {
        return Repeater::make($name)
            ->label(__('Content Elements'))
            ->schema([
                Select::make('type')
                    ->label(__('Element Type'))
                    ->required()
                    ->options([
                        'text' => __('Text'),
                        'heading' => __('Heading'),
                        'image' => __('Image'),
                        'video' => __('Video'),
                        'code' => __('Code'),
                        'quote' => __('Quote'),
                        'list' => __('List'),
                    ])
                    ->live()
                    ->default('text'),

                RichEditor::make('content')
                    ->label(__('Content'))
                    ->required()
                    ->columnSpanFull()
                    ->visible(fn ($get) => in_array($get('type'), ['text', 'heading', 'quote', 'list']))
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'underline',
                        'link',
                        'bulletList',
                        'orderedList',
                        'h2',
                        'h3',
                    ]),

                Textarea::make('content')
                    ->label(__('Image URL'))
                    ->required()
                    ->rows(2)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('type') === 'image'),

                Textarea::make('content')
                    ->label(__('Video URL'))
                    ->required()
                    ->rows(2)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('type') === 'video'),

                Textarea::make('content')
                    ->label(__('Code'))
                    ->required()
                    ->rows(10)
                    ->columnSpanFull()
                    ->visible(fn ($get) => $get('type') === 'code'),
            ])
            ->itemLabel(fn (array $state): ?string =>
                isset($state['type'])
                    ? __(ucfirst($state['type']))
                    : null
            )
            ->collapsible()
            ->collapsed()
            ->reorderable()
            ->addActionLabel(__('Add Content Element'))
            ->defaultItems(0)
            ->columnSpanFull();
    }
}

