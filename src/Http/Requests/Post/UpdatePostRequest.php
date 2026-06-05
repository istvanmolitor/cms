<?php

declare(strict_types=1);

namespace Molitor\Cms\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Molitor\Cms\Models\Post;
use Molitor\Cms\Rules\ContentElementValidator;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('acl', 'cms_post');
    }

    /**
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $post = $this->route('post');
        $id = $post instanceof Post ? $post->id : $post;

        return [
            'title' => 'sometimes|required|string|max:255',
            'slug' => 'sometimes|required|string|max:255|unique:posts,slug,'.$id,
            'is_published' => 'nullable|boolean',
            'lead' => 'nullable|string',
            'layout' => 'nullable|string|max:255',
            'main_image_url' => 'nullable|string|max:2048',
            'language_id' => 'nullable|exists:languages,id',
            'content' => 'sometimes|required|array',
            'content.content_elements' => 'sometimes|required|array|min:1',
            'content.content_elements.*.type' => 'required|string|max:255',
            'content.content_elements.*.settings' => ['required', 'array', new ContentElementValidator],
            'content.content_elements.*.sort' => 'required|integer',
            'author_ids' => 'nullable|array',
            'author_ids.*' => 'exists:authors,id',
            'post_group_ids' => 'nullable|array',
            'post_group_ids.*' => 'exists:post_groups,id',
        ];
    }
}
