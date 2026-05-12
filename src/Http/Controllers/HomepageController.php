<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Theme\Services\LayoutService;

class HomepageController
{
    public function __construct(
        private LayoutService $layoutService
    ) {}

    public function index(): View|Response
    {
        $layout = $this->layoutService->getLayoutTemplate();

        return view('cms::homepage.index', [
            'layout' => $layout,
        ]);
    }
}
