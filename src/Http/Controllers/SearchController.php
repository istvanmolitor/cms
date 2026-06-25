<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Molitor\Cms\Repositories\PostRepositoryInterface;

class SearchController extends Controller
{
    public function __construct(
        private PostRepositoryInterface $postRepository,
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

        return template('cms::search.index', compact('posts', 'query'));
    }
}
