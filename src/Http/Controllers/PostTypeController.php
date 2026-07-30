<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Repositories\PostTypeRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\BladeUi\Services\LayoutService;

class PostTypeController
{
    public function __construct(
        private PostTypeRepositoryInterface $postTypeRepository,
        private PostRepositoryInterface $postRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm,
    ) {}

    public function show(string $slug): View|Response
    {
        $postType = $this->postTypeRepository->getBySlug($slug);

        if (! $postType) {
            abort(404);
        }

        $posts = $this->postRepository->getByPostType($postType, [
            'per_page' => (int) $this->cmsSettingForm->get('post_list_per_page'),
        ]);

        $layout = $this->layoutService->getLayoutTemplate($this->cmsSettingForm->get('post_list_layout'));

        return template('cms::post-type.show', [
            'layout' => $layout,
            'postType' => $postType,
            'posts' => $posts,
        ]);
    }
}
