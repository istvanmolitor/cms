<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Menu;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'language_id' => 'required|integer|exists:languages,id',
        ];
    }
}
