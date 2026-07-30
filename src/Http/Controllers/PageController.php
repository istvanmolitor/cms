<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\BladeUi\Services\LayoutService;

class PageController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository,
        private LayoutService $layoutService
    ) {}

    public function show(string $slug): View|Response
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (! $page) {
            abort(404);
        }

        $page->load('content.contentElements');

        $layout = $this->layoutService->getLayoutTemplate($page->layout);

        return template('cms::page.show', [
            'layout' => $layout,
            'page' => $page,
        ]);
    }
}
