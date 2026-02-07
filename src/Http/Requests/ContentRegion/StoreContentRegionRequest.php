<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\ContentRegion;

use Illuminate\Foundation\Http\FormRequest;
use Molitor\Cms\Rules\ContentElementValidator;

class StoreContentRegionRequest extends FormRequest
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
        return [
            'name' => 'required|string|max:255|unique:content_regions,name',
            'content' => 'required|array',
            'content.content_elements' => 'required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.content' => ['required', 'array', new ContentElementValidator()],
            'content.content_elements.*.sort' => 'required|integer',
            'content.content_elements.*.is_visible' => 'required|boolean',
        ];
    }
}
