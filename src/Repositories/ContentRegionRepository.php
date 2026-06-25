<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Molitor\Cms\Models\ContentRegion;
use Molitor\Cms\Services\ContentHandler;

class ContentRegionRepository implements ContentRegionRepositoryInterface
{
    public function __construct(
        private ContentRegion $contentRegion,
        private ContentRepositoryInterface $contentRepository,
        private ContentHandler $contentHandler
    ) {}

    public function getAll(?string $search = null): Collection
    {
        $query = $this->contentRegion->newQuery();

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        return $query->orderBy('name')->get();
    }

    public function getById(int $id): ?ContentRegion
    {
        return $this->contentRegion->find($id);
    }

    public function getByName(string $name): ?ContentRegion
    {
        return $this->contentRegion->where('name', $name)->first();
    }

    public function create(array $data): ContentRegion
    {
        $contentRegion = $this->contentRegion->create([
            'name' => $data['name'],
            'content_id' => $this->contentRepository->create()->id,
        ]);

        if (isset($data['content']['content_elements'])) {
            $content = $contentRegion->content;
            if ($content) {
                /** @var ContentElementRepositoryInterface $elementRepository */
                $elementRepository = app(ContentElementRepositoryInterface::class);

                foreach ($data['content']['content_elements'] as $elementData) {
                    $elementRepository->create(
                        $content,
                        $elementData['type'],
                        $elementData['content'],
                        $elementData['sort'] ?? 0,
                        $elementData['is_visible'] ?? true
                    );
                }
            }
        }

        return $contentRegion;
    }

    public function update(ContentRegion $contentRegion, array $data): ContentRegion
    {
        if (isset($data['content']['content_elements'])) {
            $content = $contentRegion->content;
            if ($content) {
                /** @var ContentElementRepositoryInterface $elementRepository */
                $elementRepository = app(ContentElementRepositoryInterface::class);

                $elementRepository->deleteByContent($content);

                foreach ($data['content']['content_elements'] as $elementData) {
                    $elementRepository->create(
                        $content,
                        $elementData['type'],
                        $elementData['settings'],
                    );
                }
            }
        }

        $contentRegion->update($data);

        return $contentRegion;
    }

    public function delete(ContentRegion $contentRegion): void
    {
        $contentRegion->delete();
    }
}
