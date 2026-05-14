<?php

namespace Molitor\Cms\Services\ContentElementTypes;

use Molitor\Cms\Models\PageGroup;

class PageGroupElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'page_group';
    }

    public function getLabel(): string
    {
        return __('Page Group');
    }

    public function serialize(array $data): string
    {
        return serialize([
            'page_group_id' => isset($data['page_group_id']) ? (int) $data['page_group_id'] : null,
            'limit' => isset($data['limit']) ? (int) $data['limit'] : 5,
        ]);
    }

    public function unserialize(string $content): array
    {
        if (empty($content)) {
            return $this->getDefaultSettings();
        }

        if ($this->isJson($content)) {
            $data = json_decode($content, true);

            return [
                'page_group_id' => $data['page_group_id'] ?? null,
                'limit' => $data['limit'] ?? 5,
            ];
        }

        $data = @unserialize($content);

        if ($data === false && $content !== serialize(false)) {
            return $this->getDefaultSettings();
        }

        return [
            'page_group_id' => $data['page_group_id'] ?? null,
            'limit' => $data['limit'] ?? 5,
        ];
    }

    public function getValidationRules(): array
    {
        return [
            'page_group_id' => 'required|integer|exists:page_groups,id',
            'limit' => 'required|integer|min:1|max:100',
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.page-group';
    }

    public function getDefaultSettings(): array
    {
        return [
            'page_group_id' => null,
            'limit' => 5,
        ];
    }

    /**
     * Prepare data for the view
     */
    public function prepare(array $settings): array
    {
        return [
            'settings' => $settings,
            'pages' => $this->getPages($settings),
        ];
    }

    /**
     * Get pages for the selected group
     */
    public function getPages(array $settings)
    {
        if (empty($settings['page_group_id'])) {
            return collect();
        }

        $pageGroup = PageGroup::find($settings['page_group_id']);

        if (!$pageGroup) {
            return collect();
        }

        return $pageGroup->pages()
            ->where('is_published', true)
            ->latest()
            ->limit($settings['limit'] ?? 5)
            ->get();
    }
}
