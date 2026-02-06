<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\ContentRegion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateContentRegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = $this->route('id');

        return [
            'name' => 'sometimes|required|string|max:255|unique:content_regions,name,' . $id,
            'content' => 'sometimes|array',
            'content.content_elements' => 'sometimes|array',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.content' => 'required|string',
            'content.content_elements.*.sort' => 'required|integer',
            'content.content_elements.*.is_visible' => 'required|boolean',
        ];
    }
}
