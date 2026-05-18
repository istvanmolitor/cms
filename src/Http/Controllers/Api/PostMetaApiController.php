<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\PostMeta\StorePostMetaRequest;
use Molitor\Cms\Http\Requests\PostMeta\UpdatePostMetaRequest;
use Molitor\Cms\Http\Resources\PostMetaResource;
use Molitor\Cms\Models\PostMeta;
use Molitor\Cms\Repositories\PostMetaRepositoryInterface;

class PostMetaApiController
{
    public function __construct(
        private PostMetaRepositoryInterface $postMetaRepository
    ) {}

    public function index(int $postId): AnonymousResourceCollection
    {
        return PostMetaResource::collection($this->postMetaRepository->getAllForPost($postId));
    }

    public function show(PostMeta $postMeta): PostMetaResource
    {
        return new PostMetaResource($postMeta);
    }

    public function store(StorePostMetaRequest $request): PostMetaResource
    {
        $postMeta = $this->postMetaRepository->create($request->validated());

        return new PostMetaResource($postMeta);
    }

    public function update(UpdatePostMetaRequest $request, PostMeta $postMeta): PostMetaResource
    {
        $postMeta = $this->postMetaRepository->update($postMeta, $request->validated());

        return new PostMetaResource($postMeta);
    }

    public function destroy(PostMeta $postMeta): JsonResponse
    {
        $this->postMetaRepository->delete($postMeta);

        return response()->json(null, 204);
    }
}
