<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PageRepositoryInterface;

class PageController
{
    public function __construct(
        private PageRepositoryInterface $pageRepository
    ) {
    }

    public function show(string $slug): View|Response
    {
        $page = $this->pageRepository->getBySlug($slug);

        if (!$page) {
            abort(404);
        }

        // Load the content relationship with content elements
        $page->load('content.contentElements');

        return view('cms::page.show', [
            'page' => $page,
        ]);
    }
}

