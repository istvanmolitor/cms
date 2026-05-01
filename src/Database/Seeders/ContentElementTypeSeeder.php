<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Models\ContentElementType;
use Molitor\Cms\Services\ContentHandler;

class ContentElementTypeSeeder extends Seeder
{
    public function run(): void
    {
        /** @var ContentHandler $contentHandler */
        $contentHandler = app(ContentHandler::class);

        $types = $contentHandler->getOptions();

        foreach ($types as $typeName => $label) {
            ContentElementType::firstOrCreate(
                ['name' => $typeName],
                ['name' => $typeName]
            );

            $this->command->info("Content Element Type '{$typeName}' ensured.");
        }
    }
}
