<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Repositories\AuthorRepositoryInterface;
use Molitor\Theme\Services\LayoutService;

class AuthorController
{
    public function __construct(
        private AuthorRepositoryInterface $authorRepository,
        private LayoutService $layoutService
    ) {}

    public function index(): View|Response
    {
        $authors = $this->authorRepository->getAll(['paginate' => true]);
        $layout = $this->layoutService->getLayoutTemplate();

        return view('cms::author.index', [
            'layout' => $layout,
            'authors' => $authors,
        ]);
    }

    public function show(string $slug): View|Response
    {
        $author = $this->authorRepository->getBySlug($slug);

        if (! $author) {
            abort(404);
        }

        $posts = $author->posts()->orderBy('created_at', 'desc')->paginate(10);
        $layout = $this->layoutService->getLayoutTemplate();

        return view('cms::author.show', [
            'layout' => $layout,
            'author' => $author,
            'posts' => $posts,
        ]);
    }
}
