<?php

namespace Molitor\Cms\Filament\Resources\ContentRegionResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Molitor\Cms\Filament\Resources\ContentRegionResource;
use Molitor\Cms\Models\Content;

class EditContentRegion extends EditRecord
{
    protected static string $resource = ContentRegionResource::class;

    public function getTitle(): string
    {
        return __('Edit Content Region');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load content elements into the nested structure
        if ($this->record->content) {
            $data['content'] = [
                'contentElements' => $this->record->content->contentElements()
                    ->where('is_visible', true)
                    ->orderBy('sort', 'asc')
                    ->get()
                    ->map(fn ($element) => [
                        'type' => $element->type,
                        'content' => $element->content,
                    ])
                    ->toArray(),
            ];
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Handle content elements update
        if (isset($data['content']['contentElements'])) {
            $content = $this->record->content;

            if (!$content) {
                $content = Content::create([]);
                $data['content_id'] = $content->id;
            }

            // Delete existing content elements
            $content->contentElements()->delete();

            // Create new content elements
            foreach ($data['content']['contentElements'] as $index => $element) {
                $content->contentElements()->create([
                    'type' => $element['type'],
                    'content' => $element['content'],
                    'sort' => $index,
                    'is_visible' => true,
                ]);
            }

            unset($data['content']);
        }

        return $data;
    }
}

