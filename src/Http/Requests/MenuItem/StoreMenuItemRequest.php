<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;

class StoreMenuItemRequest extends FormRequest
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
            'menu_id' => 'required|exists:menus,id',
            'label' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'sort' => 'integer',
            'is_external' => 'boolean',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menu_items,id',
        ];
    }
}
