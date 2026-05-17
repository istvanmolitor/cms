<?php

declare(strict_types=1);

namespace Molitor\Cms\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Molitor\Cms\Models\Post;

class PostRepository implements PostRepositoryInterface
{
    public function __construct(
        private Post $post,
        private ContentRepositoryInterface $contentRepository
    ) {}

    public function getAll(): Collection
    {
        return $this->post->with(['postGroups'])->get();
    }

    public function getById(int $id): ?Post
    {
        return $this->post->find($id);
    }

    public function getBySlug(string $slug): ?Post
    {
        return $this->post->where('slug', $slug)->first();
    }

    public function existsBySlug(string $slug): bool
    {
        return $this->post->where('slug', $slug)->exists();
    }

    public function generateUniqueSlug(string $title, string $fallback = 'post'): string
    {
        $baseSlug = Str::slug($title);
        $baseSlug = $baseSlug !== '' ? $baseSlug : $fallback;

        $slug = $baseSlug;
        $counter = 1;

        while ($this->existsBySlug($slug)) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        return $slug;
    }

    public function create(
        string $title,
        string $slug,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null,
    ): Post {
        $data = [
            'title' => $title,
            'slug' => $slug,
            'content_id' => $this->contentRepository->create()->id,
        ];

        if ($isPublished !== null) {
            $data['is_published'] = $isPublished;
        }

        if ($lead !== null) {
            $data['lead'] = $lead;
        }

        if ($layout !== null) {
            $data['layout'] = $layout;
        }

        if ($mainImageUrl !== null) {
            $data['main_image_url'] = $mainImageUrl;
        }

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        return $this->post->create($data);
    }

    public function update(
        Post $post,
        ?string $title = null,
        ?string $slug = null,
        ?bool $isPublished = null,
        ?string $lead = null,
        ?string $layout = null,
        ?string $mainImageUrl = null,
        ?int $languageId = null
    ): Post {
        $data = [];

        if ($title !== null) {
            $data['title'] = $title;
        }

        if ($slug !== null) {
            $data['slug'] = $slug;
        }

        if ($isPublished !== null) {
            $data['is_published'] = $isPublished;
        }

        if ($lead !== null) {
            $data['lead'] = $lead;
        }

        if ($layout !== null) {
            $data['layout'] = $layout;
        }

        if ($mainImageUrl !== null) {
            $data['main_image_url'] = $mainImageUrl;
        }

        if ($languageId !== null) {
            $data['language_id'] = $languageId;
        }

        $post->update($data);

        return $post;
    }

    public function delete(Post $post): void
    {
        $content = $post->content;
        $post->delete();
        if ($content) {
            $this->contentRepository->delete($content);
        }
    }
}
