<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\PostType;

class PostTypeSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            ['name' => 'Cikk', 'slug' => 'article'],
            ['name' => 'Hír', 'slug' => 'news'],
            ['name' => 'Blog bejegyzés', 'slug' => 'blog'],
            ['name' => 'Esemény', 'slug' => 'event'],
        ];

        foreach ($types as $type) {
            PostType::firstOrCreate(
                ['slug' => $type['slug']],
                ['name' => $type['name']]
            );

            $this->command->info("Post Type '{$type['slug']}' ensured.");
        }
    }
}
