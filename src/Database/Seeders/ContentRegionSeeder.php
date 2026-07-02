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
        /** @var ContentRegionRepositoryInterface $contentRegionRepository */
        $contentRegionRepository = app(ContentRegionRepositoryInterface::class);

        /** @var ContentElementRepositoryInterface $contentElementRepository */
        $contentElementRepository = app(ContentElementRepositoryInterface::class);

        /** @var ContentHandler $contentHandler */
        $contentHandler = app(ContentHandler::class);

        $region = $contentRegionRepository->getByName('homepage');

        if (! $region) {
            $region = $contentRegionRepository->create(['name' => 'homepage']);
        }

        $content = $region->content;

        if ($content) {
            $hasLatestPosts = $contentElementRepository->getByContent($content)
                ->contains(fn ($element) => $contentHandler->getTypeName($element) === 'latest-posts');

            if (! $hasLatestPosts) {
                $contentHandler->createContentElement($content, 'latest-posts', []);
            }
        }

        $this->command->info("Content region 'homepage' ensured with Latest Posts element.");
    }
}
