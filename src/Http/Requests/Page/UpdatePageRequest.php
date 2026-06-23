<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Molitor\Cms\Models\Page;
use Molitor\Cms\Rules\ContentElementValidator;

class UpdatePageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms_page');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $page = $this->route('page');
        $id = $page instanceof Page ? $page->id : $page;

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,'.$id,
            'is_published' => 'nullable|boolean',
            'lead' => 'nullable|string',
            'layout' => 'sometimes|required|string|max:255',
            'main_image_url' => 'nullable|string|max:2048',
            'keywords' => 'nullable|string|max:1000',
            'language_id' => 'sometimes|required|exists:languages,id',
            'page_type_id' => 'nullable|exists:page_types,id',
            'content' => 'sometimes|nullable|array',
            'content.content_elements' => 'sometimes|nullable|array',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.settings' => ['required', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
