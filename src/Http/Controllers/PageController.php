<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PageRepositoryInterface;
use Molitor\Cms\Services\LayoutService;

class PageController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository,
        private LayoutService $layoutService
    ) {}

    public function index(): View|Response
    {
        $layout = $this->layoutService->getLayoutTemplate(null);

        return view('cms::page.index', [
            'layout' => $layout,
        ]);
    }

    public function homepage(): View|Response
    {
        $layout = $this->layoutService->getLayoutTemplate(null);

        return view('cms::page.homepage', [
            'layout' => $layout,
        ]);
    }

    public function show(string $slug): View|Response
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (! $page) {
            abort(404);
        }

        $page->load('content.contentElements');

        $layout = $this->layoutService->getLayoutTemplate($page->layout);

        return view('cms::page.show', [
            'layout' => $layout,
            'page' => $page,
        ]);
    }
}
