<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreMenuRequest extends FormRequest
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
            'language_id' => 'required|integer|exists:languages,id',
        ];
    }
}
