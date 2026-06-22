<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\PostType\StorePostTypeRequest;
use Molitor\Cms\Http\Requests\PostType\UpdatePostTypeRequest;
use Molitor\Cms\Http\Resources\PostTypeResource;
use Molitor\Cms\Repositories\PostTypeRepositoryInterface;

class PostTypeApiController
{
    public function __construct(
        private PostTypeRepositoryInterface $postTypeRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        $postTypes = $this->postTypeRepository->getAll();

        return PostTypeResource::collection($postTypes);
    }

    public function show(int $id): JsonResponse|PostTypeResource
    {
        $postType = $this->postTypeRepository->getById($id);

        if (! $postType) {
            return response()->json(['error' => 'Post type not found'], 404);
        }

        return new PostTypeResource($postType);
    }

    public function store(StorePostTypeRequest $request): PostTypeResource
    {
        $postType = $this->postTypeRepository->create($request->validated());

        return new PostTypeResource($postType);
    }

    public function update(UpdatePostTypeRequest $request, int $id): JsonResponse|PostTypeResource
    {
        $postType = $this->postTypeRepository->getById($id);

        if (! $postType) {
            return response()->json(['error' => 'Post type not found'], 404);
        }

        $postType = $this->postTypeRepository->update($postType, $request->validated());

        return new PostTypeResource($postType);
    }

    public function destroy(int $id): JsonResponse
    {
        $postType = $this->postTypeRepository->getById($id);

        if (! $postType) {
            return response()->json(['error' => 'Post type not found'], 404);
        }

        $this->postTypeRepository->delete($postType);

        return response()->json(null, 204);
    }
}
