<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Molitor\Cms\Http\Requests\MenuItem\StoreMenuItemRequest;
use Molitor\Cms\Http\Requests\MenuItem\UpdateMenuItemRequest;
use Molitor\Cms\Http\Resources\MenuItemResource;
use Molitor\Cms\Repositories\MenuItemRepositoryInterface;

class MenuItemApiController
{
    public function __construct(
        private MenuItemRepositoryInterface $menuItemRepository
    ) {}

    public function index(): AnonymousResourceCollection
    {
        // Alapvetően minden menüpontot visszaadhatunk, de általában menu_id alapján szűrünk
        // Itt most egy egyszerű listát adunk vissza, vagy a kérés alapján szűrhetünk
        $menuId = request()->query('menu_id');
        if ($menuId) {
            $menuItems = $this->menuItemRepository->getByMenuId((int) $menuId);
        } else {
            // Ha nincs menu_id, akkor pl. az összeset, bár ez ritka
            return MenuItemResource::collection([]);
        }

        return MenuItemResource::collection($menuItems);
    }

    public function show(int $id): JsonResponse|MenuItemResource
    {
        $menuItem = $this->menuItemRepository->getById($id);

        if (! $menuItem) {
            return response()->json([
                'error' => 'Menu item not found',
            ], 404);
        }

        return new MenuItemResource($menuItem);
    }

    public function store(StoreMenuItemRequest $request): MenuItemResource
    {
        $menuItem = $this->menuItemRepository->create($request->validated());

        return new MenuItemResource($menuItem);
    }

    public function update(UpdateMenuItemRequest $request, int $id): JsonResponse|MenuItemResource
    {
        $menuItem = $this->menuItemRepository->getById($id);

        if (! $menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $menuItem = $this->menuItemRepository->update($menuItem, $request->validated());

        return new MenuItemResource($menuItem);
    }

    public function destroy(int $id): JsonResponse
    {
        $menuItem = $this->menuItemRepository->getById($id);

        if (! $menuItem) {
            return response()->json(['error' => 'Menu item not found'], 404);
        }

        $this->menuItemRepository->delete($menuItem);

        return response()->json(null, 204);
    }
}
