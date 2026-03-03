<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\Menu\StoreMenuRequest;
use Molitor\Cms\Http\Requests\Menu\UpdateMenuRequest;
use Molitor\Cms\Http\Resources\MenuResource;
use Molitor\Cms\Repositories\MenuRepositoryInterface;

class MenuApiController
{
    public function __construct(
        private MenuRepositoryInterface $menuRepository
    ) {
    }

    public function index(): AnonymousResourceCollection
    {
        $menus = $this->menuRepository->getAll();

        return MenuResource::collection($menus);
    }

    public function show(int $id): JsonResponse|MenuResource
    {
        $menu = $this->menuRepository->getById($id);

        if (!$menu) {
            return response()->json([
                'error' => 'Menu not found'
            ], 404);
        }

        return new MenuResource($menu);
    }

    public function store(StoreMenuRequest $request): MenuResource
    {
        $menu = $this->menuRepository->create($request->validated()['name']);

        return new MenuResource($menu);
    }

    public function update(UpdateMenuRequest $request, int $id): JsonResponse|MenuResource
    {
        $menu = $this->menuRepository->getById($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $menu = $this->menuRepository->update($menu, $request->validated());

        return new MenuResource($menu);
    }

    public function destroy(int $id): JsonResponse
    {
        $menu = $this->menuRepository->getById($id);

        if (!$menu) {
            return response()->json(['error' => 'Menu not found'], 404);
        }

        $this->menuRepository->delete($menu);

        return response()->json(null, 204);
    }
}
