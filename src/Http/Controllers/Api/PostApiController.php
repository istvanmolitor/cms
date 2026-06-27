<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Search\Http\Requests\SearchRequest;
use Illuminate\Support\Facades\Log;
use Molitor\Admin\Traits\HasAdminFilters;
use Molitor\Cms\Data\ContentDto;
use Molitor\Search\Services\SearchService;
use Molitor\Cms\Http\Requests\Post\StorePostRequest;
use Molitor\Cms\Http\Requests\Post\UpdatePostRequest;
use Molitor\Cms\Http\Resources\PostResource;
use Molitor\Cms\Models\Post;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class PostApiController
{
    use HasAdminFilters;

    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function index(SearchRequest $request): AnonymousResourceCollection|JsonResponse
    {
        $result = (new SearchService(Post::class))
            ->fromRequest($request)
            ->search();

        $response = PostResource::collection($result->items());

        if ($result->isPaginated() && ($request->wantsJson() || $request->ajax())) {
            return $response->additional($result->getAdditionals());
        }

        return $response;
    }

    public function show(Post $post): PostResource
    {
        $post->load('content.contentElements.children');
        $post->load('authors');
        $post->load('postGroups');
        $post->load('postMeta');
        $post->load('language');
        $post->load('postType');

        return new PostResource($post);
    }

    public function store(StorePostRequest $request, ContentHandler $contentHandler): PostResource
    {
        try {
            $content = ContentDto::fromArray($request->content);
            $post = $this->postRepository->create(
                title: $request->title,
                slug: $request->slug,
                isPublished: $request->is_published,
                lead: $request->lead,
                layout: $request->layout,
                mainImageUrl: $request->main_image_url,
                languageId: $request->language_id,
                postTypeId: $request->post_type_id
            );

            $contentHandler->saveContentDto($post->content, $content);

            if (isset($request->author_ids)) {
                $post->authors()->sync($request->author_ids);
            }

            if (isset($request->post_group_ids)) {
                $post->postGroups()->sync($request->post_group_ids);
            }

            return new PostResource($post);
        } catch (\Exception $e) {
            Log::error('Error creating post', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function update(UpdatePostRequest $request, Post $post, ContentHandler $contentHandler): PostResource
    {
        $post = $this->postRepository->update($post,
            title: $request->title,
            slug: $request->slug,
            isPublished: $request->is_published,
            lead: $request->lead,
            layout: $request->layout,
            mainImageUrl: $request->main_image_url,
            languageId: $request->language_id,
            postTypeId: $request->post_type_id
        );

        $contentHandler->saveContentDto($post->content, ContentDto::fromArray($request->content));

        if (isset($request->author_ids)) {
            $post->authors()->sync($request->author_ids);
        }

        if (isset($request->post_group_ids)) {
            $post->postGroups()->sync($request->post_group_ids);
        }

        $post->load('content.contentElements.children', 'authors', 'postGroups', 'postMeta', 'postType');

        return new PostResource($post);
    }

    public function destroy(Post $post): JsonResponse
    {
        $this->postRepository->delete($post);

        return response()->json(null, 204);
    }

    public function getBySlug(string $slug): JsonResponse|PostResource
    {
        $post = $this->postRepository->getBySlug($slug);

        if (! $post) {
            return response()->json(['error' => 'Post not found'], 404);
        }

        $post->load('content.contentElements.children');
        $post->load('authors');
        $post->load('postGroups');
        $post->load('postMeta');
        $post->load('language');
        $post->load('postType');

        return new PostResource($post);
    }
}
