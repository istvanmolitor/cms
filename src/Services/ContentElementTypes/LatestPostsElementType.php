<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Molitor\Cms\Repositories\PostRepositoryInterface;

class LatestPostsElementType extends BaseContentElementType
{
    public function __construct(
        private PostRepositoryInterface $postRepository
    ) {}

    public function getName(): string
    {
        return 'latest-posts';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Latest Posts');
    }

    public function prepare(array $data): array
    {
        return [
            'limit' => isset($data['limit']) ? max(1, (int) $data['limit']) : 5,
        ];
    }

    public function getCalculated(array $settings): array
    {
        $limit = $settings['limit'] ?? 5;

        return [
            'posts' => $this->postRepository->getLatest($limit),
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'limit' => 'required|integer|min:1|max:50',
        ];
    }
}
