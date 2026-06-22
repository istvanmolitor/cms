<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\PageType\StorePageTypeRequest;
use Molitor\Cms\Http\Requests\PageType\UpdatePageTypeRequest;
use Molitor\Cms\Http\Resources\PageTypeResource;
use Molitor\Cms\Repositories\PageTypeRepositoryInterface;

class PageTypeApiController
{
    public function __construct(
        private PageTypeRepositoryInterface $pageTypeRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $pageTypes = $this->pageTypeRepository->getAll();

        return PageTypeResource::collection($pageTypes);
    }

    public function show(int $id): JsonResponse|PageTypeResource
    {
        $pageType = $this->pageTypeRepository->getById($id);

        if (! $pageType) {
            return response()->json(['error' => 'Page type not found'], 404);
        }

        return new PageTypeResource($pageType);
    }

    public function store(StorePageTypeRequest $request): PageTypeResource
    {
        $pageType = $this->pageTypeRepository->create($request->validated());

        return new PageTypeResource($pageType);
    }

    public function update(UpdatePageTypeRequest $request, int $id): JsonResponse|PageTypeResource
    {
        $pageType = $this->pageTypeRepository->getById($id);

        if (! $pageType) {
            return response()->json(['error' => 'Page type not found'], 404);
        }

        $pageType = $this->pageTypeRepository->update($pageType, $request->validated());

        return new PageTypeResource($pageType);
    }

    public function destroy(int $id): JsonResponse
    {
        $pageType = $this->pageTypeRepository->getById($id);

        if (! $pageType) {
            return response()->json(['error' => 'Page type not found'], 404);
        }

        $this->pageTypeRepository->delete($pageType);

        return response()->json(null, 204);
    }
}
