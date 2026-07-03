<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\Menu;
use Molitor\Cms\Models\MenuItem;
use Molitor\Language\Repositories\LanguageRepositoryInterface;

class MenuSeeder extends Seeder
{
    public function __construct(private LanguageRepositoryInterface $languageRepository) {}

    public function run(): void
    {
        $language = $this->languageRepository->getDefaultLanguage();

        if (! $language) {
            $this->command->warn('No default language found. Please seed languages first.');

            return;
        }

        $menus = [
            'main' => [
                ['label' => 'Főoldal', 'url' => '/', 'sort' => 1],
                ['label' => 'Hírek', 'url' => '/post', 'sort' => 2],
                ['label' => 'Rólunk', 'url' => '/rolunk', 'sort' => 3],
                ['label' => 'Kapcsolat', 'url' => '/contact', 'sort' => 4],
            ],
            'footer' => [
                ['label' => 'Impresszum', 'url' => '/impresszum', 'sort' => 1],
                ['label' => 'Hírek', 'url' => '/post', 'sort' => 2],
                ['label' => 'Adatvédelem', 'url' => '/adatvedelem', 'sort' => 2],
                ['label' => 'Süti tájékoztató', 'url' => '/sutik', 'sort' => 3],
            ],
            'social' => [
                ['label' => 'Facebook', 'url' => 'https://facebook.com', 'sort' => 1],
                ['label' => 'Instagram', 'url' => 'https://instagram.com', 'sort' => 2],
                ['label' => 'Twitter', 'url' => 'https://twitter.com', 'sort' => 3],
                ['label' => 'LinkedIn', 'url' => 'https://linkedin.com', 'sort' => 4],
            ],
            'post_type' => [
            ],
            'post_group' => [
            ],
            'keyword' => [
            ],
        ];

        foreach ($menus as $name => $items) {
            $menu = Menu::firstOrCreate(
                ['name' => $name, 'language_id' => $language->id],
            );

            $seededUrls = array_column($items, 'url');
            MenuItem::where('menu_id', $menu->id)
                ->whereNotIn('url', $seededUrls)
                ->delete();

            foreach ($items as $item) {
                MenuItem::updateOrCreate(
                    ['menu_id' => $menu->id, 'url' => $item['url']],
                    ['label' => $item['label'], 'sort' => $item['sort'], 'is_external' => false],
                );
            }
        }

        $this->command->info('Menus ensured.');
    }
}
