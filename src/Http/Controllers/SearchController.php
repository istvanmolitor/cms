<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Theme\Services\LayoutService;

class SearchController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm,
    ) {}

    public function __invoke(Request $request): View
    {
        $query = $request->string('q')->trim()->value();

        $posts = $this->postRepository->getAll([
            'search'   => $query,
            'paginate' => true,
            'per_page' => 12,
        ]);

        if ($posts instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $posts->getCollection()->load('authors', 'postGroups');
            $posts->appends(['q' => $query]);
        }

        $layoutName = $this->cmsSettingForm->get('search_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return template('cms::search.index', compact('posts', 'query', 'layout'));
    }
}
