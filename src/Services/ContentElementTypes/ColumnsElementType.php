<?php

namespace Molitor\Cms\Services\ContentElementTypes;

class ColumnsElementType extends BaseContentElementType
{
    public function getName(): string
    {
        return 'columns';
    }

    public function getLabel(): string
    {
        return __('Columns');
    }

    public function serialize(array $data): string
    {
        $columns = [];

        if (isset($data['columns']) && is_array($data['columns'])) {
            foreach ($data['columns'] as $column) {
                $columns[] = [
                    'content_elements' => $column['content_elements'] ?? [],
                    'width' => $column['width'] ?? null,
                ];
            }
        }

        return serialize([
            'columns' => $columns,
            'columns_count' => $data['columns_count'] ?? count($columns),
        ]);
    }

    public function unserialize(string $content): array
    {
        // Handle empty content
        if (empty($content)) {
            return $this->getDefaultSettings();
        }

        // Check if content is JSON (for backward compatibility or migration)
        if ($this->isJson($content)) {
            $data = json_decode($content, true);

            return [
                'columns' => $data['columns'] ?? [],
                'columns_count' => $data['columns_count'] ?? 0,
            ];
        }

        // Attempt to unserialize with error handling
        $data = @unserialize($content);

        // If unserialize failed, try to handle gracefully
        if ($data === false && $content !== serialize(false)) {
            error_log('Failed to unserialize content in ColumnsElementType: '.$content);

            return $this->getDefaultSettings();
        }

        return [
            'columns' => $data['columns'] ?? [],
            'columns_count' => $data['columns_count'] ?? 0,
        ];
    }

    public function getDefaultSettings(): array
    {
        return [
            'columns' => [
                [
                    'content_elements' => [],
                    'width' => '50%',
                ],
                [
                    'content_elements' => [],
                    'width' => '50%',
                ],
            ],
            'columns_count' => 2,
        ];
    }

    public function getTemplate(): string
    {
        return 'cms::components.content-elements.columns';
    }

    public function getValidationRules(): array
    {
        return [
            'columns' => 'required|array',
            'columns.*.content_elements' => 'array',
            'columns.*.width' => 'nullable|string',
            'columns_count' => 'required|integer|min:1',
        ];
    }
}
