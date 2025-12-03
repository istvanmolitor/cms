<?php

namespace Molitor\Cms\Filament\Forms\Components;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Molitor\Cms\Services\ContentElementHandler;

class ContentEditor
{
    public static function make(string $name = 'contentElements'): Repeater
    {
        $handler = app(ContentElementHandler::class);

        return Repeater::make($name)
            ->label(__('Content Elements'))
            ->schema([
                Select::make('type')
                    ->label(__('Element Type'))
                    ->required()
                    ->options(fn () => $handler->getOptions())
                    ->live()
                    ->default('text')
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('content', null);
                    }),

                ...self::getAllFormFields($handler),
            ])
            ->itemLabel(fn (array $state): ?string =>
                isset($state['type'])
                    ? $handler->getElementType($state['type'])?->getLabel()
                    : null
            )
            ->collapsible()
            ->collapsed()
            ->addActionLabel(__('Add Content Element'))
            ->defaultItems(0)
            ->columnSpanFull();
    }

    private static function getAllFormFields(ContentElementHandler $handler): array
    {
        $allFields = [];

        foreach ($handler->getOptions() as $type => $label) {
            $fields = $handler->getFormFields($type);

            foreach ($fields as $field) {
                $field->visible(fn ($get) => $get('type') === $type);
                $allFields[] = $field;
            }
        }

        return $allFields;
    }
}

