<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Models\ContentElementType;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface;
use Molitor\Cms\Services\ContentElementTypes\BaseContentElementType;

class ContentHandler
{
    private array $elementTypes = [];

    public function __construct(
        private ContentElementRepositoryInterface $contentElementRepository,
        private ContentElementTypeRepositoryInterface $contentElementTypeRepository,
    )
    {
    }

    public function addElementType(BaseContentElementType $elementType): void
    {
        $this->elementTypes[$elementType->getName()] = $elementType;
    }

    public function getElementType(string $type): BaseContentElementType|null
    {
        return $this->elementTypes[$type] ?? null;
    }

    public function getOptions(): array
    {
        $options = [];
        /** @var BaseContentElementType $elementType */
        foreach ($this->elementTypes as $elementType) {
            $options[$elementType->getName()] = $elementType->getLabel();
        }
        return $options;
    }

    public function getContentElementType(ContentElement $contentElement): ?ContentElementType
    {
        return $this->contentElementTypeRepository->getById($contentElement->content_element_type_id);
    }

    public function getContentData(ContentElement $contentElement): array
    {
        $contentElementType = $this->getContentElementType($contentElement);
        if(!$contentElementType) {
            return [];
        }
        $type = $this->getElementType($contentElementType->name);
        if(!$type) {
            return[];
        }
        return $type->unserialize($contentElement->content);
    }

    public function saveContentData(ContentElement $contentElement, string $typeName, array $data, int $sort): void
    {
        $type = $this->getElementType($typeName);
        if(!$type) {
            return;
        }
        $contentElementType = $this->contentElementTypeRepository->getByName($type->getName());
        $contentElement->content_element_type_id = $contentElementType->id;
        $contentElement->content = $type->serialize($data);
        $contentElement->sort = $sort;
        $contentElement->save();
    }

    public function createContentElement(Content $content, string $typeName, array $data, int $sort): ContentElement
    {
        $contentElement = new ContentElement();
        $contentElement->content_id = $content->id;
        $contentElement->sort = $sort;
        $this->saveContentData($contentElement, $typeName, $data, $sort);
        return $contentElement;
    }

    private function prepareElement(array $element): array
    {
        return [
            'id' => $element['id'] ?? null,
            'type' => $element['type'] ??  null,
            'content' => $element['content'] ?? null,
        ];
    }

    public function sevaContentElements(Content $content, array $elements): void
    {
        $oldElements = [];
        $i = 0;
        foreach ($this->contentElementRepository->getByContent($content) as $element) {
            $oldElements[$i] = $element;
            $i++;
        }
        $sort = 0;
        foreach ($elements as $element) {
            $element = $this->prepareElement($element);

            if(array_key_exists($sort, $oldElements)) {
                $this->saveContentData($oldElements[$sort], $element['type'], $element['content'], $sort);
            }
            else {
                $this->createContentElement($content, $element['type'], $element['content'], $sort);
            }
            $sort++;
        }
        for ($i = count($elements); $i < count($oldElements); $i++) {
            $this->contentElementRepository->delete($oldElements[$i]);
        }
    }

    public function elementToArray(ContentElement $contentElement): ?array
    {
        $contentElementType = $this->getContentElementType($contentElement);
        if(!$contentElementType) {
            return null;
        }

        return [
            'id' => $contentElement->id,
            'type' => $contentElementType->name,
            'content' => $this->getContentData($contentElement),
            'visible' => $contentElement->visible,
        ];
    }
}
