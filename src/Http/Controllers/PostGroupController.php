<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostGroupRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Theme\Services\LayoutService;

class PostGroupController
{
    public function __construct(
        private PostGroupRepositoryInterface $postGroupRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm,
    ) {}

    public function index(): View|Response
    {
        $postGroups = $this->postGroupRepository->getAll();
        $layout = $this->layoutService->getLayoutTemplate();

        return template('cms::post-group.index', [
            'layout' => $layout,
            'postGroups' => $postGroups,
        ]);
    }

    public function show(string $slug): View|Response
    {
        $postGroup = $this->postGroupRepository->getBySlug($slug);

        if (! $postGroup) {
            abort(404);
        }

        $posts = $postGroup->posts()->paginate((int) $this->cmsSettingForm->get('post_group_per_page'));
        $layout = $this->layoutService->getLayoutTemplate($postGroup->layout);

        return template('cms::post-group.show', [
            'layout' => $layout,
            'postGroup' => $postGroup,
            'posts' => $posts,
        ]);
    }
}
