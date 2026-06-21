<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Author;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateAuthorRequest extends FormRequest
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
            'profile_url' => 'nullable|string|max:255',
        ];
    }
}
