<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Keyword\Repositories\KeywordGroupRepositoryInterface;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;
use Molitor\BladeUi\Services\LayoutService;

class KeywordController
{
    public function __construct(
        private KeywordRepositoryInterface $keywordRepository,
        private KeywordGroupRepositoryInterface $keywordGroupRepository,
        private PostRepositoryInterface $postRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm
    ) {}

    public function show(string $slug): View|Response
    {
        $keyword = $this->keywordRepository->getBySlug($slug);

        if (! $keyword) {
            abort(404);
        }

        $posts = $this->postRepository->getByKeyword($keyword);

        $layoutName = $this->cmsSettingForm->get('post_list_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return template('cms::keyword.show', [
            'layout' => $layout,
            'keyword' => $keyword,
            'posts' => $posts,
        ]);
    }

    public function groups(): View|Response
    {
        $keywordGroups = $this->keywordGroupRepository->getAll();

        $layout = $this->layoutService->getLayoutTemplate();

        return template('cms::keyword.groups', [
            'layout' => $layout,
            'keywordGroups' => $keywordGroups,
        ]);
    }
}
