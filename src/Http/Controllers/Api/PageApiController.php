<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\Page\StorePageRequest;
use Molitor\Cms\Http\Requests\Page\UpdatePageRequest;
use Molitor\Cms\Http\Resources\PageResource;
use Molitor\Cms\Repositories\PageRepositoryInterface;

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

    public function store(StorePageRequest $request): PageResource
    {
        $data = $request->validated();

        $page = $this->pageRepository->create($data);

        return new PageResource($page);
    }

    public function update(UpdatePageRequest $request, int $id): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $data = $request->validated();

        $page = $this->pageRepository->update($page, $data);

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

