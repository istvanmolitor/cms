<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\ContentRegion\StoreContentRegionRequest;
use Molitor\Cms\Http\Requests\ContentRegion\UpdateContentRegionRequest;
use Molitor\Cms\Http\Resources\ContentRegionResource;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class ContentRegionApiController
{
    public function __construct(
        private ContentRegionRepositoryInterface $contentRegionRepository
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $regions = $this->contentRegionRepository->getAll();

        return ContentRegionResource::collection($regions);
    }

    public function show(int $id): JsonResponse|ContentRegionResource
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json([
                'error' => 'Content region not found'
            ], 404);
        }

        $region->load('content.contentElements');
        $region->load('draftContent.contentElements');

        return new ContentRegionResource($region);
    }

    public function store(StoreContentRegionRequest $request): ContentRegionResource
    {
        $data = $request->validated();

        $region = $this->contentRegionRepository->create($data);

        return new ContentRegionResource($region);
    }

    public function update(UpdateContentRegionRequest $request, int $id, ContentHandler $contentHandler): JsonResponse|ContentRegionResource
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json(['error' => 'Content region not found'], 404);
        }

        $data = $request->validated();

        $region->name = $request->name;

        // Create draft content if it doesn't exist
        if (!$region->draft_content_id) {
            $draftContent = app(\Molitor\Cms\Repositories\ContentRepositoryInterface::class)->create();
            $region->draft_content_id = $draftContent->id;
        }

        $region->save();

        // Update draft content instead of published content
        $contentHandler->sevaContentElements($region->draftContent, $data['content']['content_elements'] ?? []);

        // Reload relationships
        $region->load('content.contentElements');
        $region->load('draftContent.contentElements');

        return new ContentRegionResource($region);
    }

    public function approveDraft(int $id): JsonResponse|ContentRegionResource
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json(['error' => 'Content region not found'], 404);
        }

        $this->contentRegionRepository->approveDraft($region);

        // Reload relationships
        $region->load('content.contentElements');
        $region->load('draftContent.contentElements');

        return new ContentRegionResource($region);
    }

    public function resetDraft(int $id): JsonResponse|ContentRegionResource
    {
        $region = $this->contentRegionRepository->getById($id);

        if (!$region) {
            return response()->json(['error' => 'Content region not found'], 404);
        }

        $this->contentRegionRepository->resetDraft($region);

        // Reload relationships
        $region->load('content.contentElements');
        $region->load('draftContent.contentElements');

        return new ContentRegionResource($region);
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
