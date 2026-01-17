<?php

namespace App\Http\Requests;

use App\Models\Content;
use Illuminate\Foundation\Http\FormRequest;

class ContentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('content'));
    }

    public function rules(): array
    {
        return [
            'title'        => 'sometimes|string|max:255',
            'slug'         => 'sometimes|string|max:255|unique:contents,slug,' . $this->route('content')->id,
            'content'      => 'sometimes|string',
            'category_id'  => 'sometimes|exists:categories,id',
            'published_at' => 'nullable|date',
            'is_active'    => 'boolean',
        ];
    }
}
