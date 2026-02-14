<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Page;

use Illuminate\Foundation\Http\FormRequest;
use Molitor\Cms\Rules\ContentElementValidator;

class UpdatePageRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:pages,slug,' . $id,
            /*
            'content' => 'sometimes|required|array',
            'content.content_elements' => 'sometimes|required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.content' => ['required', 'array', new ContentElementValidator()],
            'content.content_elements.*.sort' => 'required|integer',
            'content.content_elements.*.is_visible' => 'required|boolean',
            */
        ];
    }
}
