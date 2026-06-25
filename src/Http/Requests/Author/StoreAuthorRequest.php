<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms_author');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'nullable|string|max:255|unique:authors,slug',
            'nickname' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'profile_url' => 'nullable|string|max:255',
            'layout' => 'required|string|max:255',
        ];
    }
}
