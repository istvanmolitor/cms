<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Molitor\Cms\Rules\ContentElementValidator;

class StorePageRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:pages,slug',
            'is_published' => 'nullable|boolean',
            'lead' => 'nullable|string|max:255',
            'layout' => 'nullable|string|max:255',
            'main_image_url' => 'nullable|string|max:2048',
            'language_id' => 'nullable|exists:languages,id',
            'content' => 'required|array',
            'content.content_elements' => 'required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            //'content.content_elements.*.settings' => 'required|array',
            'content.content_elements.*.sort' => 'required|integer',
            'author_ids' => 'nullable|array',
            'author_ids.*' => 'exists:authors,id',
            'page_group_ids' => 'nullable|array',
            'page_group_ids.*' => 'exists:page_groups,id',
        ];
    }
}
