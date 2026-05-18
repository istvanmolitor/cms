<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Admin\Traits\HasAdminFilters;
use Molitor\Cms\Http\Requests\Author\StoreAuthorRequest;
use Molitor\Cms\Http\Requests\Author\UpdateAuthorRequest;
use Molitor\Cms\Http\Resources\AuthorResource;
use Molitor\Cms\Repositories\AuthorRepositoryInterface;

class AuthorApiController
{
    use HasAdminFilters;

    public function __construct(
        private AuthorRepositoryInterface $authorRepository
    ) {}

    public function index(Request $request): AnonymousResourceCollection|JsonResponse
    {
        $params = $request->only(['search', 'sort', 'direction', 'page', 'per_page']);
        $params['paginate'] = true;

        $authors = $this->authorRepository->getAll($params);

        if ($request->wantsJson() || $request->ajax()) {
            return AuthorResource::collection($authors)->additional([
                'meta' => [
                    'current_page' => $authors->currentPage(),
                    'last_page' => $authors->lastPage(),
                    'per_page' => $authors->perPage(),
                    'total' => $authors->total(),
                ],
                'filters' => $request->only(['search', 'sort', 'direction']),
            ]);
        }

        return AuthorResource::collection($authors);
    }

    public function show(int $id): JsonResponse|AuthorResource
    {
        $author = $this->authorRepository->getById($id);

        if (! $author) {
            return response()->json([
                'error' => 'Author not found',
            ], 404);
        }

        return new AuthorResource($author);
    }

    public function store(StoreAuthorRequest $request): AuthorResource
    {
        $author = $this->authorRepository->create($request->validated());

        return new AuthorResource($author);
    }

    public function update(UpdateAuthorRequest $request, int $id): JsonResponse|AuthorResource
    {
        $author = $this->authorRepository->getById($id);

        if (! $author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        $author = $this->authorRepository->update($author, $request->validated());

        return new AuthorResource($author);
    }

    public function destroy(int $id): JsonResponse
    {
        $author = $this->authorRepository->getById($id);

        if (! $author) {
            return response()->json(['error' => 'Author not found'], 404);
        }

        $this->authorRepository->delete($author);

        return response()->json(null, 204);
    }
}
