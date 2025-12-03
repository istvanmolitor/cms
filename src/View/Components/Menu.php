<?php

declare(strict_types=1);

namespace Molitor\Cms\View\Components;

use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Molitor\Cms\Repositories\MenuRepositoryInterface;

class Menu extends Component
{
    public function __construct(
        protected MenuRepositoryInterface $menuRepository,
        protected string $name
    ) {

    }

    public function render(): View
    {

        $menu = app('menu')->build('main');
        dd($menu);

        return view('cms::components.main-menu', [
            'menu' => $this->menuRepository->getByName($this->name),
        ]);
    }
}

