<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\Page\StorePageRequest;
use Molitor\Cms\Http\Requests\Page\UpdatePageRequest;
use Molitor\Cms\Http\Resources\PageResource;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class PageApiController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $pages = $this->pageRepository->getAll();

        return PageResource::collection($pages);
    }

    public function show(int $id): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json([
                'error' => 'Page not found'
            ], 404);
        }

        // Load the content relationship with content elements
        $page->load('content.contentElements');
        $page->load('draftContent.contentElements');
        $page->load('authors');
        $page->load('pageGroups');
        $page->load('language');

        return new PageResource($page);
    }

    public function store(StorePageRequest $request, ContentHandler $contentHandler): PageResource
    {
        $data = $request->all();

        $page = $this->pageRepository->create($data);

        $contentHandler->sevaContentElements($page->content, $data['content']['content_elements'] ?? []);

        // Sync authors if provided
        if (isset($data['author_ids'])) {
            $page->authors()->sync($data['author_ids']);
        }

        // Sync page groups if provided
        if (isset($data['page_group_ids'])) {
            $page->pageGroups()->sync($data['page_group_ids']);
        }

        return new PageResource($page);
    }

    public function update(UpdatePageRequest $request, int $id, ContentHandler $contentHandler): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $data = $request->all();

        $page->title = $request->title;
        $page->slug = $request->slug;

        if ($request->has('language_id')) {
            $page->language_id = $request->language_id;
        }

        if ($request->has('main_image_url')) {
            $page->main_image_url = $request->main_image_url;
        }

        // Create draft content if it doesn't exist
        if (!$page->draft_content_id) {
            $draftContent = app(\Molitor\Cms\Repositories\ContentRepositoryInterface::class)->create();
            $page->draft_content_id = $draftContent->id;
        }

        $page->save();

        // Update draft content instead of published content
        $contentHandler->sevaContentElements($page->draftContent, $data['content']['content_elements'] ?? []);

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
        $page->load('draftContent.contentElements');

        return new PageResource($page);
    }

    public function approveDraft(int $id): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $this->pageRepository->approveDraft($page);

        // Reload relationships
        $page->load('content.contentElements');
        $page->load('draftContent.contentElements');

        return new PageResource($page);
    }

    public function resetDraft(int $id): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $this->pageRepository->resetDraft($page);

        // Reload relationships
        $page->load('content.contentElements');
        $page->load('draftContent.contentElements');

        return new PageResource($page);
    }

    public function destroy(int $id): JsonResponse
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $this->pageRepository->delete($page);

        return response()->json(null, 204);
    }

    public function getBySlug(string $slug): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->load('content.contentElements');
        $page->load('authors');
        $page->load('pageGroups');
        $page->load('language');

        return new PageResource($page);
    }
}

