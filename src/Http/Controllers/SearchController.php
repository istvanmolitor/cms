<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Search\Http\Requests\SearchRequest;
use Molitor\Search\Searchers\BaseSearcher;
use Molitor\BladeUi\Services\LayoutService;

class SearchController extends Controller
{
    public function __construct(
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm,
    ) {}

    public function __invoke(SearchRequest $request): View
    {
        $query = $request->getSearch() ?? '';

        $searcherClass = config('cms.post_searcher');
        $searcher = app($searcherClass);

        if (!$searcher instanceof BaseSearcher) {
            throw new \InvalidArgumentException("cms.post_searcher must be an instance of BaseSearcher, [{$searcherClass}] given.");
        }

        $posts = $searcher->search($request->toSearchParams());
        $posts->appends($request->except('page'));

        $layoutName = $this->cmsSettingForm->get('search_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return template('cms::search.index', compact('posts', 'query', 'layout'));
    }
}
