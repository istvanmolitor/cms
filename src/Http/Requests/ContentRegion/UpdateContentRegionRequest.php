<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\ContentRegion;

use Illuminate\Foundation\Http\FormRequest;
use Molitor\Cms\Rules\ContentElementValidator;

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
        $id = $this->route('region') ?: $this->route('id');

        return [
            'name' => 'sometimes|required|string|max:255|unique:content_regions,name,'.$id,
            'content' => 'sometimes|required|array',
            'content.content_elements' => 'sometimes|required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.settings' => ['required', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
