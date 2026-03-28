<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuItemRequest extends FormRequest
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
            'label' => 'sometimes|string|max:255',
            'url' => 'sometimes|string|max:255',
            'sort' => 'sometimes|integer',
            'is_external' => 'sometimes|boolean',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
        ];
    }
}
