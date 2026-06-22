<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePageRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'is_published' => 'nullable|boolean',
            'lead' => 'nullable|string',
            'layout' => 'nullable|string|max:255',
            'main_image_url' => 'nullable|string|max:2048',
            'keywords' => 'nullable|string|max:1000',
            'language_id' => 'nullable|exists:languages,id',
            'page_type_id' => 'nullable|exists:page_types,id',
            'content' => 'required|array',
            'content.content_elements' => 'required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            // 'content.content_elements.*.settings' => 'required|array',
            'content.content_elements.*.sort' => 'required|integer',
        ];
    }
}
