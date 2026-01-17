<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Category::class);
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'slug'      => 'required|string|max:120|unique:categories,slug',
            'is_active' => 'boolean',
        ];
    }
}
