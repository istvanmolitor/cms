<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;

class ContentRegionApiController
{
    public function __construct(
        private ContentRegionRepositoryInterface $contentRegionRepository
    ) {
    }

    public function index(): JsonResponse
    {
        $regions = $this->contentRegionRepository->getAll();

        return response()->json([
            'data' => $regions->map(function ($region) {
                return [
                    'id' => $region->id,
                    'name' => $region->name,
                ];
            })->values()->toArray()
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json([
                'error' => 'Content region not found'
            ], 404);
        }

        return response()->json([
            'data' => [
                'id' => $region->id,
                'name' => $region->name,
                'content' => $region->content ? [
                    'id' => $region->content->id,
                    'elements' => $region->content->contentElements->map(function ($element) {
                        return [
                            'id' => $element->id,
                            'type' => $element->type,
                            'content' => $element->content,
                        ];
                    })->values()->toArray(),
                ] : null,
            ]
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:content_regions,name',
        ]);

        $region = $this->contentRegionRepository->create($data['name']);

        return response()->json([
            'data' => $region
        ], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json(['error' => 'Content region not found'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255|unique:content_regions,name,' . $id,
        ]);

        $region = $this->contentRegionRepository->update($region, $data);

        return response()->json([
            'data' => $region
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json(['error' => 'Content region not found'], 404);
        }

        $this->contentRegionRepository->delete($region);

        return response()->json(null, 204);
    }
}
