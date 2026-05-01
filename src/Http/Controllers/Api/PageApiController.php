<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Molitor\Cms\Data\ContentDto;
use Molitor\Cms\Http\Requests\Page\StorePageRequest;
use Molitor\Cms\Http\Requests\Page\UpdatePageRequest;
use Molitor\Cms\Http\Resources\PageResource;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class PageApiController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $pages = $this->pageRepository->getAll();

        return PageResource::collection($pages);
    }

    public function show(int $id): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (! $page) {
            return response()->json([
                'error' => 'Page not found',
            ], 404);
        }

        // Load the content relationship with content elements
        $page->load('content.contentElements');
        $page->load('authors');
        $page->load('pageGroups');
        $page->load('language');

        return new PageResource($page);
    }

    public function store(StorePageRequest $request, ContentHandler $contentHandler): PageResource
    {
        try {
            $data = $request->all();

            $contentDto = ContentDto::fromArray($data['content']);
            dd($contentDto);


            $page = $this->pageRepository->create(
                title: $data['title'],
                slug: $data['slug'],
                isPublished: $data['is_published'] ?? null,
                lead: $data['lead'] ?? null,
                layout: $data['layout'],
                mainImageUrl: $data['main_image_url'] ?? null,
                languageId: $data['language_id']
            );

            // Load the content relationship
            $page->load('content');

            if ($page->content && isset($data['content'])) {
                $contentDto = ContentDto::fromArray($data['content']);
                $contentHandler->saveContentDto($contentDto);
            }

            // Sync authors if provided
            if (isset($data['author_ids'])) {
                $page->authors()->sync($data['author_ids']);
            }

            // Sync page groups if provided
            if (isset($data['page_group_ids'])) {
                $page->pageGroups()->sync($data['page_group_ids']);
            }

            Log::info('Page creation completed successfully');

            return new PageResource($page);
        } catch (\Exception $e) {
            Log::error('Error creating page', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function update(UpdatePageRequest $request, int $id, ContentHandler $contentHandler): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (! $page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $data = $request->all();

        // Update page using repository's update method with validated data
        $updateData = $request->only([
            'title',
            'slug',
            'is_published',
            'lead',
            'layout',
            'language_id',
            'main_image_url',
        ]);

        $page = $this->pageRepository->update($page, $updateData);

        // Update draft content instead of published content
        if (isset($data['content'])) {
            $contentDto = ContentDto::fromArray($data['content']);
            $contentHandler->saveContentDto($page->content, $contentDto);
        }

        // Sync authors if provided
        if (isset($data['author_ids'])) {
            $page->authors()->sync($data['author_ids']);
        }

        // Sync page groups if provided
        if (isset($data['page_group_ids'])) {
            $page->pageGroups()->sync($data['page_group_ids']);
        }

        // Reload relationships
        $page->load('content.contentElements');

        return new PageResource($page);
    }

    public function destroy(int $id): JsonResponse
    {
        $page = $this->pageRepository->getById($id);

        if (! $page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $this->pageRepository->delete($page);

        return response()->json(null, 204);
    }

    public function getBySlug(string $slug): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (! $page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->load('content.contentElements');
        $page->load('authors');
        $page->load('pageGroups');
        $page->load('language');

        return new PageResource($page);
    }
}
