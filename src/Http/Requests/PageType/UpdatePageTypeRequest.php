<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\PageType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UpdatePageTypeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms_page_type');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => [
                'required',
                'string',
                'max:255',
                Rule::unique('page_types', 'slug')->ignore($this->route('page_type')),
            ],
        ];
    }
}
