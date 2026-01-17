<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('category'));
    }

    public function rules(): array
    {
        return [
            'name'      => 'sometimes|string|max:100',
            'slug'      => 'sometimes|string|max:120|unique:categories,slug,' . $this->route('category')->id,
            'is_active' => 'boolean',
        ];
    }
}
