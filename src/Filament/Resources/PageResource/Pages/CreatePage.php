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

        // Add the content_id to the page data
        $data['content_id'] = $content->id;

        // Create and return the page
        return static::getModel()::create($data);
    }
}

