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

        return new PageResource($page);
    }

    public function store(StorePageRequest $request, ContentHandler $contentHandler): PageResource
    {
        $data = $request->all();

        $page = $this->pageRepository->create($data);

        $contentHandler->sevaContentElements($page->content, $data['content']['content_elements'] ?? []);

        return new PageResource($page);
    }

    public function update(UpdatePageRequest $request, int $id, ContentHandler $contentHandler): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->title = $request->title;
        $page->slug = $request->slug;
        $page->save();

        $contentHandler->sevaContentElements($page->content, $data['content']['content_elements'] ?? []);

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

        return new PageResource($page);
    }
}

