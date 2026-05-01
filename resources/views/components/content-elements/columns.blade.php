@php
    $columns = $settings['columns'] ?? [];
    $columnsCount = $settings['columns_count'] ?? count($columns);
@endphp

<div class="content-element content-element-columns mb-6">
    @if($columnsCount > 0)
        <div class="grid gap-6" style="grid-template-columns: repeat({{ $columnsCount }}, 1fr);">
            @foreach($columns as $columnIndex => $column)
                <div class="column">
                    @php
                        $contentElements = $column['content_elements'] ?? [];
                    @endphp

                    @if(is_array($contentElements) && count($contentElements) > 0)
                        @foreach($contentElements as $elementData)
                            @php
                                // Render each content element within the column
                                // This requires the ContentHandler to render the element
                                $contentHandler = app(\Molitor\Cms\Services\ContentHandler::class);

                                // Create a temporary ContentElement object for rendering
                                $tempElement = new \Molitor\Cms\Models\ContentElement();
                                $tempElement->is_visible = $elementData['is_visible'] ?? true;

                                // Get the element type by name
                                try {
                                    $elementType = $contentHandler->getElementType($elementData['type']);
                                    $tempElement->settings = $elementType->serialize($elementData['settings'] ?? []);

                                    // Get the content element type ID
                                    $contentElementTypeRepo = app(\Molitor\Cms\Repositories\ContentElementTypeRepositoryInterface::class);
                                    $tempElement->content_element_type_id = $contentElementTypeRepo->getIdByName($elementData['type']);

                                    $renderedElement = $contentHandler->renderElement($tempElement);
                                } catch (\Exception $e) {
                                    $renderedElement = '';
                                }
                            @endphp

                            @if($tempElement->is_visible)
                                {!! $renderedElement !!}
                            @endif
                        @endforeach
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

