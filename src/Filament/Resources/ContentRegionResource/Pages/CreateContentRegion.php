<?php

namespace Molitor\Cms\Filament\Resources\ContentRegionResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Molitor\Cms\Filament\Resources\ContentRegionResource;
use Molitor\Cms\Models\Content;

class CreateContentRegion extends CreateRecord
{
    protected static string $resource = ContentRegionResource::class;

    public function getTitle(): string
    {
        return __('Create Content Region');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Always create a Content record
        $content = Content::create([]);

        // Create content elements if provided
        if (isset($data['content']['contentElements']) && is_array($data['content']['contentElements'])) {
            foreach ($data['content']['contentElements'] as $index => $element) {
                $content->contentElements()->create([
                    'type' => $element['type'],
                    'content' => $element['content'],
                    'sort' => $index,
                    'is_visible' => true,
                ]);
            }
        }

        $data['content_id'] = $content->id;
        unset($data['content']);

        return $data;
    }
}

