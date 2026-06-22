<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\PageType;

class PageTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Alap oldal', 'slug' => 'default'],
            ['name' => 'Kezdőlap', 'slug' => 'home'],
            ['name' => 'Kapcsolat', 'slug' => 'contact'],
            ['name' => 'Rólunk', 'slug' => 'about'],
        ];

        foreach ($types as $type) {
            PageType::firstOrCreate(
                ['slug' => $type['slug']],
                ['name' => $type['name']]
            );

            $this->command->info("Page Type '{$type['slug']}' ensured.");
        }
    }
}
