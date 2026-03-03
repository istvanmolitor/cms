<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\PageGroup;

use Illuminate\Foundation\Http\FormRequest;

class StorePageGroupRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:page_groups,slug',
            'layout' => 'nullable|string|max:255',
        ];
    }
}

