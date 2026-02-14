<?php

namespace Molitor\Cms\Filament\Resources\PageResource\Pages;

use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Molitor\Cms\Filament\Resources\PageResource;
use Molitor\Cms\Services\ContentHandler;

class EditPage extends EditRecord
{
    protected static string $resource = PageResource::class;

    public function getTitle(): string
    {
        return __('Edit Page');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('view')
                ->label(__('View'))
                ->icon('heroicon-o-eye')
                ->url(fn (): string => route('cms.page.show', ['slug' => $this->record->slug]))
                ->openUrlInNewTab(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Ensure the content relationship is loaded
        $this->record->load('content.contentElements');

        // Add content elements to the form data
        if ($this->record->content) {
            $handler = app(ContentHandler::class);

            $data['contentElements'] = $this->record->content->contentElements
                ->map(function ($element) use ($handler) {
                    $deserializedData = $handler->deserialize($element->type, $element->content);
                    return array_merge([
                        'id' => $element->id,
                        'type' => $element->type,
                    ], $deserializedData);
                })
                ->toArray();
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        // Extract content elements from data
        $contentElements = $data['contentElements'] ?? [];
        unset($data['contentElements']);

        // Update the page
        $record->update($data);

        // Get the content
        $content = $record->content;

        if ($content) {
            $handler = app(ContentHandler::class);

            // Get existing element IDs
            $existingIds = collect($contentElements)
                ->pluck('id')
                ->filter()
                ->toArray();

            // Delete elements that are no longer present
            $content->contentElements()
                ->whereNotIn('id', $existingIds)
                ->delete();

            // Update or create elements
            foreach ($contentElements as $elementData) {
                if (isset($elementData['id'])) {
                    // Update existing element
                    $content->contentElements()
                        ->where('id', $elementData['id'])
                        ->update([
                            'type' => $elementData['type'],
                            'content' => $handler->serialize($elementData['type'], $elementData),
                        ]);
                } else {
                    // Create new element
                    $content->contentElements()->create([
                        'type' => $elementData['type'],
                        'content' => $handler->serialize($elementData['type'], $elementData),
                    ]);
                }
            }
        }

        return $record;
    }
}

