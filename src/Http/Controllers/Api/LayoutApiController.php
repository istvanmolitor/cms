<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Molitor\BladeUi\Services\LayoutService;

class LayoutApiController
{
    public function __construct(
        private LayoutService $layoutService
    ) {}

    /**
     * Get all available layouts.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->layoutService->getLayouts(),
        ]);
    }
}
