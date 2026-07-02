<?php

namespace Molitor\Cms\Database\Seeders;

use Illuminate\Database\Seeder;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentRegionRepositoryInterface;
use Molitor\Cms\Services\ContentHandler;

class ContentRegionSeeder extends Seeder
{
    public function run(): void
    {
        $this->ensureElement('homepage', 'latest-posts', []);
        $this->ensureElement('homepage-top', 'hero', [
            'title' => 'Naprakész hírek, megbízható forrásból',
            'lead' => 'Kövesse nyomon a legfontosabb híreket és eseményeket, elfogulatlan tájékoztatással.',
        ]);
    }

    private function ensureElement(string $regionName, string $elementType, array $settings): void
    {
        /** @var ContentRegionRepositoryInterface $contentRegionRepository */
        $contentRegionRepository = app(ContentRegionRepositoryInterface::class);

        /** @var ContentElementRepositoryInterface $contentElementRepository */
        $contentElementRepository = app(ContentElementRepositoryInterface::class);

        /** @var ContentHandler $contentHandler */
        $contentHandler = app(ContentHandler::class);

        $region = $contentRegionRepository->getByName($regionName);

        if (! $region) {
            $region = $contentRegionRepository->create(['name' => $regionName]);
        }

        $content = $region->content;

        if ($content) {
            $hasElement = $contentElementRepository->getByContent($content)
                ->contains(fn ($element) => $contentHandler->getTypeName($element) === $elementType);

            if (! $hasElement) {
                $contentHandler->createContentElement($content, $elementType, $settings);
            }
        }

        $this->command->info("Content region '{$regionName}' ensured with '{$elementType}' element.");
    }
}
