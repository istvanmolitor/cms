<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\DataTables\PostGroupDataTable;
use Molitor\Cms\Http\Requests\PostGroup\StorePostGroupRequest;
use Molitor\Cms\Http\Requests\PostGroup\UpdatePostGroupRequest;
use Molitor\Cms\Http\Resources\PostGroupResource;
use Molitor\Cms\Repositories\PostGroupRepositoryInterface;

class PostGroupApiController
{
    public function __construct(
        private PostGroupRepositoryInterface $postGroupRepository
    ) {}

    public function index(PostGroupDataTable $dataTable): AnonymousResourceCollection
    {
        return $dataTable->getResponse();
    }

    public function show(int $id): JsonResponse|PostGroupResource
    {
        $postGroup = $this->postGroupRepository->getById($id);

        if (! $postGroup) {
            return response()->json([
                'error' => 'Post group not found',
            ], 404);
        }

        $postGroup->load('posts');

        return new PostGroupResource($postGroup);
    }

    public function store(StorePostGroupRequest $request): PostGroupResource
    {
        $postGroup = $this->postGroupRepository->create($request->validated());

        return new PostGroupResource($postGroup);
    }

    public function update(UpdatePostGroupRequest $request, int $id): JsonResponse|PostGroupResource
    {
        $postGroup = $this->postGroupRepository->getById($id);

        if (! $postGroup) {
            return response()->json(['error' => 'Post group not found'], 404);
        }

        $postGroup = $this->postGroupRepository->update($postGroup, $request->validated());

        return new PostGroupResource($postGroup);
    }

    public function destroy(int $id): JsonResponse
    {
        $postGroup = $this->postGroupRepository->getById($id);

        if (! $postGroup) {
            return response()->json(['error' => 'Post group not found'], 404);
        }

        $this->postGroupRepository->delete($postGroup);

        return response()->json(null, 204);
    }
}
