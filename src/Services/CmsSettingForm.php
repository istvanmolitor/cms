<?php

declare(strict_types=1);

namespace Molitor\Cms\Services;

use Molitor\Setting\Enums\SettingFieldType;
use Molitor\Setting\Services\SettingForm;
use Molitor\Theme\Services\LayoutService;

class CmsSettingForm extends SettingForm
{
    public function getSlug(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return 'CMS';
    }

    public function getFields(): array
    {
        return [
            'homepage_layout' => [
                'label' => 'Főoldal layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'post_list_layout' => [
                'label' => 'Post lista layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'author_list_layout' => [
                'label' => 'Author lista layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'search_layout' => [
                'label' => 'Keresési találatok layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
        ];
    }

    private function getLayoutOptions(): array
    {
        $options = [];
        foreach (app(LayoutService::class)->getLayouts() as $key => $layout) {
            $options[] = ['value' => $key, 'label' => $layout['name']];
        }

        return $options;
    }
}
