<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Theme\Services\LayoutService;

class PostController
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm
    ) {}

    public function index(): View|Response
    {
        $posts = $this->postRepository->getAll([
            'is_published' => true,
            'paginate' => true,
            'per_page' => 10,
        ]);

        $layoutName = $this->cmsSettingForm->get('post_list_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);
        return view('cms::post.index', [
            'layout' => $layout,
            'posts' => $posts,
        ]);
    }

    public function show(string $slug): View|Response
    {
        $post = $this->postRepository->getBySlug($slug);

        if (! $post) {
            abort(404);
        }

        $post->load(['content.contentElements', 'authors', 'postGroups']);

        $layout = $this->layoutService->getLayoutTemplate($post->layout);
        
        return view('cms::post.show', [
            'layout' => $layout,
            'post' => $post,
        ]);
    }
}
