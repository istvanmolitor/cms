<?php

namespace Molitor\Cms\Services;

use Molitor\Cms\Exceptions\InvalidElementException;
use Molitor\Cms\Exceptions\InvalidElementTypeNameException;
use Molitor\Cms\Models\Content;
use Molitor\Cms\Models\ContentElement;
use Molitor\Cms\Models\ContentElementType;
use Molitor\Cms\Repositories\ContentElementRepositoryInterface;
use Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface;
use Molitor\Cms\Services\ContentElementTypes\BaseContentElementType;
use Molitor\Cms\Services\ContentElementTypes\CodeElementType;
use Molitor\Cms\Services\ContentElementTypes\HeadingElementType;
use Molitor\Cms\Services\ContentElementTypes\ImageElementType;
use Molitor\Cms\Services\ContentElementTypes\ListElementType;
use Molitor\Cms\Services\ContentElementTypes\QuoteElementType;
use Molitor\Cms\Services\ContentElementTypes\TextElementType;
use Molitor\Cms\Services\ContentElementTypes\VideoElementType;

class ContentHandler
{
    private array $elementTypes = [];

    public function __construct(
        private ContentElementRepositoryInterface $contentElementRepository,
        private ContentElementTypeRepositoryInterface $contentElementTypeRepository,
    )
    {
        $this->initElementTypes();
    }

    public function initElementTypes(): void
    {
        $this->registerElementType(new TextElementType());
        $this->registerElementType(new HeadingElementType());
        $this->registerElementType(new ImageElementType());
        $this->registerElementType(new VideoElementType());
        $this->registerElementType(new CodeElementType());
        $this->registerElementType(new QuoteElementType());
        $this->registerElementType(new ListElementType());
    }

    public function registerElementType(BaseContentElementType $elementType): void
    {
        $this->elementTypes[$elementType->getName()] = $elementType;
    }

    public function getElementType(string $type): BaseContentElementType
    {
        if(!array_key_exists($type, $this->elementTypes)) {
            throw new InvalidElementTypeNameException($type);
        }
        return $this->elementTypes[$type];
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
        return $type->unserialize($contentElement->settings);
    }

    public function saveContentData(ContentElement $contentElement, string $typeName, array $settings): void
    {
        $type = $this->getElementType($typeName);
        $this->contentElementRepository->update(
            $contentElement,
            $this->contentElementTypeRepository->getIdByName($type->getName()),
            $type->serialize($settings)
        );
    }

    public function createContentElement(Content $content, string $typeName, array $settings): ContentElement
    {
        $type = $this->getElementType($typeName);

        return $this->contentElementRepository->create(
            $content,
            $this->contentElementTypeRepository->getIdByName($typeName),
            $type->serialize($settings)
        );
    }

    private function prepareElement(mixed $element): array
    {
        if(!is_array($element)) {
            throw new InvalidElementException("Element must be an array");
        }

        if(!array_key_exists('type', $element) || !array_key_exists($element['type'], $this->elementTypes)) {
            throw new InvalidElementException("Element must have a valid type");
        }

        if(!array_key_exists('settings', $element) || !is_array($element['settings'])) {
            throw new InvalidElementException("Element must have settings as an array");
        }

        return [
            'type' => $element['type'],
            'settings' => $element['settings'],
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
            try {
                $element = $this->prepareElement($element);
            }
            catch (InvalidElementException $e) {
                continue;
            }

            if(array_key_exists($sort, $oldElements)) {
                $this->saveContentData($oldElements[$sort], $element['type'], $element['settings']);
            }
            else {
                $this->createContentElement($content, $element['type'], $element['settings']);
            }
            $sort++;
        }

        $this->contentElementRepository->deleteWhereSortGreaterOrEqual($content, $sort);
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

    public function getTypeName(ContentElement $contentElement): string
    {
        return $this->getContentElementType($contentElement)->name;
    }

    public function copyContentElements(Content $sourceContent, Content $targetContent): void
    {
        // Get all elements from source and target content
        $sourceElements = $this->contentElementRepository->getByContent($sourceContent);
        $targetElements = [];
        $i = 0;
        foreach ($this->contentElementRepository->getByContent($targetContent) as $element) {
            $targetElements[$i] = $element;
            $i++;
        }

        // Copy each element from source to target
        $sort = 0;
        foreach ($sourceElements as $sourceElement) {
            $contentElementType = $this->getContentElementType($sourceElement);
            if (!$contentElementType) {
                continue;
            }

            $type = $this->getElementType($contentElementType->name);
            if (!$type) {
                continue;
            }

            // If target element exists at this position, update it
            if (array_key_exists($sort, $targetElements)) {
                $this->saveContentData(
                    $targetElements[$sort],
                    $contentElementType->name,
                    $type->unserialize($sourceElement->settings)
                );
            } else {
                // Otherwise create new element
                $this->createContentElement(
                    $targetContent,
                    $contentElementType->name,
                    $type->unserialize($sourceElement->settings)
                );
            }
            $sort++;
        }

        // Delete extra elements from target if it has more elements than source
        $this->contentElementRepository->deleteWhereSortGreaterOrEqual($targetContent, $sort);
    }
}
