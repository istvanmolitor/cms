<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\ContentRegion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Molitor\Cms\Rules\ContentElementValidator;

class StoreContentRegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms');
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
            'content.content_elements.*.settings' => ['required', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
