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
            'post_list_per_page' => [
                'label' => 'Post lista – elemek oldalanként',
                'type' => SettingFieldType::Number,
                'default' => 12,
            ],
            'author_list_layout' => [
                'label' => 'Author lista layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'author_posts_per_page' => [
                'label' => 'Author oldal – posztok oldalanként',
                'type' => SettingFieldType::Number,
                'default' => 12,
            ],
            'post_group_per_page' => [
                'label' => 'Post csoport – elemek oldalanként',
                'type' => SettingFieldType::Number,
                'default' => 10,
            ],
            'search_layout' => [
                'label' => 'Keresési találatok layout',
                'type' => SettingFieldType::Select,
                'options' => $this->getLayoutOptions(),
                'default' => app(LayoutService::class)->getDefault(),
            ],
            'search_per_page' => [
                'label' => 'Keresési találatok – elemek oldalanként',
                'type' => SettingFieldType::Number,
                'default' => 12,
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
