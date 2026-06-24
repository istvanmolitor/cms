<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Molitor\Cms\Rules\ContentElementValidator;

class StorePageRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'is_published' => 'nullable|boolean',
            'lead' => 'nullable|string',
            'layout' => 'required|string|max:255',
            'main_image_url' => 'nullable|string|max:2048',
            'keywords' => 'nullable|string|max:1000',
            'language_id' => 'required|exists:languages,id',
            'page_type_id' => 'nullable|exists:page_types,id',
            'content' => 'nullable|array',
            'content.content_elements' => 'nullable|array',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.settings' => ['nullable', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
