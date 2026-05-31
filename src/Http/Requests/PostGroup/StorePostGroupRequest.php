<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\PostGroup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePostGroupRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:post_groups,slug',
            'layout' => 'nullable|string|max:255',
        ];
    }
}
