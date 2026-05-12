<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PageGroupRepositoryInterface;
use Molitor\Theme\Services\LayoutService;

class PageGroupController
{
    public function __construct(
        private PageGroupRepositoryInterface $pageGroupRepository,
        private LayoutService $layoutService
    ) {}

    public function show(string $slug): View|Response
    {
        $pageGroup = $this->pageGroupRepository->getBySlug($slug);

        if (! $pageGroup) {
            abort(404);
        }

        $pages = $pageGroup->pages()->paginate(10);
        $layout = $this->layoutService->getLayoutTemplate($pageGroup->layout);

        return view('cms::page-group.show', [
            'layout' => $layout,
            'pageGroup' => $pageGroup,
            'pages' => $pages,
        ]);
    }
}
