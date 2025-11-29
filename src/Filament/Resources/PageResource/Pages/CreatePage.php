<?php

namespace Molitor\Cms\Filament\Resources\PageResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Molitor\Cms\Filament\Resources\PageResource;
use Molitor\Cms\Repositories\ContentRepositoryInterface;

class CreatePage extends CreateRecord
{
    protected static string $resource = PageResource::class;

    public function getTitle(): string
    {
        return __('Create Page');
    }

    protected function handleRecordCreation(array $data): Model
    {
        // Get the ContentRepository from the container
        $contentRepository = app(ContentRepositoryInterface::class);

        // Get the current user's ID
        $userId = auth()->id();

        // Create a new Content record
        $content = $contentRepository->create($userId);

        // Extract content elements from data
        $contentElements = $data['contentElements'] ?? [];
        unset($data['contentElements']);

        // Add the content_id to the page data
        $data['content_id'] = $content->id;

        // Create the page
        $page = static::getModel()::create($data);

        // Create content elements
        foreach ($contentElements as $element) {
            $content->contentElements()->create([
                'type' => $element['type'],
                'content' => $element['content'],
            ]);
        }

        return $page;
    }
}

