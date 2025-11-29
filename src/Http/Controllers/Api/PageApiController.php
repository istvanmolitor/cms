<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Molitor\Cms\Repositories\PageRepositoryInterface;

class PageApiController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {
    }

    public function show(string $slug): JsonResponse
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (!$page) {
            return response()->json([
                'error' => 'Page not found'
            ], 404);
        }

        // Load the content relationship with content elements
        $page->load('content.contentElements');

        return response()->json([
            'data' => [
                'id' => $page->id,
                'title' => $page->title,
                'slug' => $page->slug,
                'content' => $page->content ? [
                    'id' => $page->content->id,
                    'elements' => $page->content->contentElements->map(function ($element) {
                        return [
                            'id' => $element->id,
                            'type' => $element->type,
                            'content' => $element->content,
                        ];
                    })->values()->toArray(),
                ] : null,
                'created_at' => $page->created_at?->toIso8601String(),
                'updated_at' => $page->updated_at?->toIso8601String(),
            ]
        ]);
    }

    public function index(): JsonResponse
    {
        $pages = $this->pageRepository->getAll();

        return response()->json([
            'data' => $pages->map(function ($page) {
                return [
                    'id' => $page->id,
                    'title' => $page->title,
                    'slug' => $page->slug,
                    'created_at' => $page->created_at?->toIso8601String(),
                    'updated_at' => $page->updated_at?->toIso8601String(),
                ];
            })->values()->toArray()
        ]);
    }
}

