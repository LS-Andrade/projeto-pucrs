<?php

namespace App\Http\Requests;

use App\Models\Content;
use Illuminate\Foundation\Http\FormRequest;

class ContentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Content::class);
    }

    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:contents,slug',
            'content'      => 'required|string',
            'category_id'  => 'required|exists:categories,id',
            'published_at' => 'nullable|date',
            'is_active'    => 'boolean',
        ];
    }
}
