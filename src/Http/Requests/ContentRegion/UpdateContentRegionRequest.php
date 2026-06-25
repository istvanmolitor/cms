<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\ContentRegion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Molitor\Cms\Rules\ContentElementValidator;

class UpdateContentRegionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms_region');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $id = $this->route('region') ?: $this->route('id');

        return [
            'name' => 'sometimes|required|string|max:255|unique:content_regions,name,'.$id,
            'content' => 'sometimes|nullable|array',
            'content.content_elements' => 'sometimes|nullable|array',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.settings' => ['required', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
