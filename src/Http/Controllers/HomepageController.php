<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\View\View;
use Molitor\Cms\Services\CmsSettingForm;
use Molitor\Theme\Services\LayoutService;

class HomepageController
{
    public function __construct(
        private LayoutService $layoutService,
        private CmsSettingForm $cmsSettingForm
    ) {}

    public function index(): View|Response
    {
        $layoutName = $this->cmsSettingForm->get('homepage_layout');
        $layout = $this->layoutService->getLayoutTemplate($layoutName);

        return template('cms::homepage.index', [
            'layout' => $layout,
        ]);
    }
}
