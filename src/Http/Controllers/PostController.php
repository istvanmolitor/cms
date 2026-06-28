<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Events\Post\PostShow;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Keyword\Repositories\KeywordRepositoryInterface;
use Molitor\Theme\Services\LayoutService;

class PostController
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private KeywordRepositoryInterface $keywordRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm
    ) {}

    public function index(): View|Response
    {
        $posts = $this->postRepository->getAll([
            'is_published' => true,
            'paginate' => true,
            'per_page' => (int) $this->cmsSettingForm->get('post_list_per_page'),
        ]);

        $layoutName = $this->cmsSettingForm->get('post_list_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);
        return template('cms::post.index', [
            'layout' => $layout,
            'posts' => $posts,
        ]);
    }

    public function byKeyword(string $slug): View|Response
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

    public function show(string $slug): View|Response
    {
        $post = $this->postRepository->getBySlug($slug);

        if (! $post) {
            abort(404);
        }

        $post->load(['content.contentElements', 'authors', 'postGroups', 'keywords']);

        PostShow::dispatch($post);

        $post->refresh();

        $layout = $this->layoutService->getLayoutTemplate($post->layout);
        
        return template('cms::post.show', [
            'layout' => $layout,
            'post' => $post,
        ]);
    }
}
