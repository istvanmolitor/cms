<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\PostMeta;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostMetaRequest extends FormRequest
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
            'post_id' => 'required|exists:posts,id',
            'name' => 'required|string|max:255',
            'meta_data' => 'nullable|string',
        ];
    }
}
