<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Log;
use Molitor\Admin\Traits\HasAdminFilters;
use Molitor\Cms\Data\ContentDto;
use Molitor\Cms\Http\Requests\Page\StorePageRequest;
use Molitor\Cms\Http\Requests\Page\UpdatePageRequest;
use Molitor\Cms\Http\Resources\PageResource;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class PageApiController
{
    use HasAdminFilters;

    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {}

    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        $params = $request->only(['search', 'sort', 'direction', 'page', 'per_page']);
        $params['paginate'] = true;

        $pages = $this->pageRepository->getAll($params);

        if ($request->wantsJson() || $request->ajax()) {
            return PageResource::collection($pages)->additional([
                'meta' => [
                    'current_page' => $pages->currentPage(),
                    'last_page' => $pages->lastPage(),
                    'per_page' => $pages->perPage(),
                    'total' => $pages->total(),
                ],
                'filters' => $request->only(['search', 'sort', 'direction']),
            ]);
        }

        return PageResource::collection($pages);
    }

    public function show(Page $page): PageResource
    {
        // Load the content relationship with content elements and their children
        $page->load('content.contentElements.children');
        $page->load('metaData');
        $page->load('language');

        return new PageResource($page);
    }

    public function store(StorePageRequest $request, ContentHandler $contentHandler): PageResource
    {
        try {
            $content = ContentDto::fromArray($request->content);
            $page = $this->pageRepository->create(
                title: $request->title,
                slug: $request->slug,
                isPublished: $request->is_published,
                lead: $request->lead,
                layout: $request->layout,
                mainImageUrl: $request->main_image_url,
                languageId: $request->language_id
            );

            $contentHandler->saveContentDto($page->content, $content);

            return new PageResource($page);
        } catch (\Exception $e) {
            Log::error('Error creating page', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            throw $e;
        }
    }

    public function update(UpdatePageRequest $request, Page $page, ContentHandler $contentHandler): PageResource
    {
        $page = $this->pageRepository->update($page,
            title: $request->title,
            slug: $request->slug,
            isPublished: $request->is_published,
            lead: $request->lead,
            layout: $request->layout,
            mainImageUrl: $request->main_image_url,
            languageId: $request->language_id
        );

        $contentHandler->saveContentDto($page->content, ContentDto::fromArray($request->content));

        // Reload relationships
        $page->load('content.contentElements.children');
        $page->load('metaData');

        return new PageResource($page);
    }

    public function destroy(Page $page): JsonResponse
    {
        $this->pageRepository->delete($page);

        return response()->json(null, 204);
    }

    public function getBySlug(string $slug): JsonResponse|PageResource
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (! $page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->load('content.contentElements.children');
        $page->load('metaData');
        $page->load('language');

        return new PageResource($page);
    }
}
