<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Molitor\Theme\Services\LayoutService;

class PostController
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
        private LayoutService $layoutService
    ) {}

    public function index(): View|Response
    {
        $layout = $this->layoutService->getLayoutTemplate();

        return view('cms::post.index', [
            'layout' => $layout,
        ]);
    }

    public function show(string $slug): View|Response
    {
        $post = $this->postRepository->getBySlug($slug);

        if (! $post) {
            abort(404);
        }

        $post->load('content.contentElements');

        $layout = $this->layoutService->getLayoutTemplate($post->layout);

        return view('cms::post.show', [
            'layout' => $layout,
            'post' => $post,
        ]);
    }
}
