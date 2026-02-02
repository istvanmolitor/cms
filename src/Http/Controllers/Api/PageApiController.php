<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Molitor\Cms\Repositories\PageRepositoryInterface;

class PageApiController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {
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

    public function show(int $id): JsonResponse
    {
        $page = $this->pageRepository->getById($id);

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

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
        ]);

        $page = $this->pageRepository->create($data);

        return response()->json([
            'data' => $page
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $page = $this->pageRepository->getById($id);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $data = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,' . $id,
        ]);

        $page = $this->pageRepository->update($page, $data);

        return response()->json([
            'data' => $page
        ]);
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

    public function getBySlug(string $slug): JsonResponse
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (!$page) {
            return response()->json(['error' => 'Page not found'], 404);
        }

        $page->load('content.contentElements');

        return response()->json([
            'data' => $page
        ]);
    }
}

