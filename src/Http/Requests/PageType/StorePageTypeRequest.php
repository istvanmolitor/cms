<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\PageType;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePageTypeRequest extends FormRequest
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
            'slug' => 'required|string|max:255|unique:page_types,slug',
        ];
    }
}
