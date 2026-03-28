<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\PageGroup\StorePageGroupRequest;
use Molitor\Cms\Http\Requests\PageGroup\UpdatePageGroupRequest;
use Molitor\Cms\Http\Resources\PageGroupResource;
use Molitor\Cms\Repositories\PageGroupRepositoryInterface;

class PageGroupApiController
{
    public function __construct(
        private PageGroupRepositoryInterface $pageGroupRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $pageGroups = $this->pageGroupRepository->getAll();

        return PageGroupResource::collection($pageGroups);
    }

    public function show(int $id): JsonResponse|PageGroupResource
    {
        $pageGroup = $this->pageGroupRepository->getById($id);

        if (! $pageGroup) {
            return response()->json([
                'error' => 'Page group not found',
            ], 404);
        }

        $pageGroup->load('pages');

        return new PageGroupResource($pageGroup);
    }

    public function store(StorePageGroupRequest $request): PageGroupResource
    {
        $pageGroup = $this->pageGroupRepository->create($request->validated());

        return new PageGroupResource($pageGroup);
    }

    public function update(UpdatePageGroupRequest $request, int $id): JsonResponse|PageGroupResource
    {
        $pageGroup = $this->pageGroupRepository->getById($id);

        if (! $pageGroup) {
            return response()->json(['error' => 'Page group not found'], 404);
        }

        $pageGroup = $this->pageGroupRepository->update($pageGroup, $request->validated());

        return new PageGroupResource($pageGroup);
    }

    public function destroy(int $id): JsonResponse
    {
        $pageGroup = $this->pageGroupRepository->getById($id);

        if (! $pageGroup) {
            return response()->json(['error' => 'Page group not found'], 404);
        }

        $this->pageGroupRepository->delete($pageGroup);

        return response()->json(null, 204);
    }
}
