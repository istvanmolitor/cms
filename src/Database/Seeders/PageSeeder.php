<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Models\PageType;
use Molitor\Language\Repositories\LanguageRepositoryInterface;

class PageSeeder extends Seeder
{
    public function __construct(private LanguageRepositoryInterface $languageRepository) {}

    public function run(): void
    {
        $language = $this->languageRepository->getDefaultLanguage();

        if (! $language) {
            $this->command->warn('No default language found. Please seed languages first.');

            return;
        }

        $defaultType = PageType::where('slug', 'default')->first();
        $aboutType = PageType::where('slug', 'about')->first();

        $pages = [
            ['title' => 'Rólunk', 'slug' => 'rolunk', 'lead' => 'Megbízható tájékoztatás, elfogulatlan hírszolgáltatás – ez a mi küldetésünk.', 'page_type' => $aboutType ?? $defaultType, 'layout' => 'container'],
            ['title' => 'Impresszum', 'slug' => 'impresszum', 'lead' => 'A portál kiadójának és szerkesztőségének adatai.', 'page_type' => $defaultType, 'layout' => 'container'],
            ['title' => 'Adatvédelmi tájékoztató', 'slug' => 'adatvedelem', 'lead' => 'Tájékoztató a személyes adatok kezeléséről és a felhasználók jogairól.', 'page_type' => $defaultType, 'layout' => 'container'],
            ['title' => 'Süti tájékoztató', 'slug' => 'sutik', 'lead' => 'Tájékoztató a weboldalon használt sütikről.', 'page_type' => $defaultType, 'layout' => 'container'],
        ];

        foreach ($pages as $data) {
            $content = Content::create([]);

            $page = Page::firstOrCreate(
                ['slug' => $data['slug'], 'language_id' => $language->id],
                [
                    'title' => $data['title'],
                    'lead' => $data['lead'],
                    'layout' => $data['layout'],
                    'is_published' => true,
                    'page_type_id' => $data['page_type']->id,
                    'content_id' => $content->id,
                ]
            );

            $this->command->info("Page '{$page->title}' ensured.");
        }
    }
}
