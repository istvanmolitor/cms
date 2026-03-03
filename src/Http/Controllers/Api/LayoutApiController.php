<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers\Api;

use Illuminate\Http\JsonResponse;
use Molitor\Cms\Services\LayoutService;

class LayoutApiController
{
    public function __construct(
        private LayoutService $layoutService
    ) {
    }

    /**
     * Get all available layouts.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => $this->layoutService->getLayouts()
        ]);
    }
}
