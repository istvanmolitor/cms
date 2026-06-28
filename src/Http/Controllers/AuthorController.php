<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Molitor\Cms\Models\Author;
use Molitor\Cms\Repositories\AuthorRepositoryInterface;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Theme\Services\LayoutService;

class AuthorController extends Controller
{
    public function __construct(
        private AuthorRepositoryInterface $authorRepository,
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm,
    ) {}

    public function index(): View
    {
        $authors = Author::withCount(['posts' => fn ($q) => $q->where('is_published', true)])
            ->orderBy('name')
            ->get();

        $layoutName = $this->cmsSettingForm->get('author_list_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return template('cms::author.index', [
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

        $posts = $author->posts()
            ->where('is_published', true)
            ->latest()
            ->paginate((int) $this->cmsSettingForm->get('author_posts_per_page'));

        $layout = $this->layoutService->getLayoutTemplate($author->layout);

        return template('cms::author.show', [
            'layout' => $layout,
            'author' => $author,
            'posts'  => $posts,
        ]);
    }
}
