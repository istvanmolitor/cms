<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Molitor\Cms\Models\Post;
use Molitor\Cms\Repositories\PostRepositoryInterface;
use Override;

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

    protected function getPost(array $settings): ?Post
    {
        $postId = $settings['post_id'] ?? null;
        if(!$postId) {
            return null;
        }
        return Post::with('authors')->find($postId);       
    }

    public function getCalculated(array $settings): array
    {
        return [
            'post' => $this->getPost($settings),
        ];
    }

    public function settingsToString(array $settings): string
    {
        $postId = $settings['post_id'];
        if(empty($postId)) {
            return '';
        }

        $post = app(PostRepositoryInterface::class)->getById($postId);
        if(!$post) {
            return '';
        }
        
        return $this->arrayToString([
            $post->title,
            $post->lead,
        ]);
    }
}
