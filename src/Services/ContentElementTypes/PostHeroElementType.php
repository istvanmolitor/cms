<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class PostHeroElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'post-hero';
    }

    public function getPackage(): string
    {
        return 'cms';
    }

    public function getLabel(): string
    {
        return __('Post Hero');
    }

    public function prepare(array $data): array
    {
        return [
            'post_id' => isset($data['post_id']) ? (int) $data['post_id'] : null,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'post_id' => 'required|integer|exists:posts,id',
        ];
    }
}
