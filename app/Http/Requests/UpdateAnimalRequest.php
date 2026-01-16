<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnimalRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('animal'));
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'species' => 'sometimes|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'gender' => 'sometimes|in:male,female',
            'age' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'status' => 'sometimes|in:available,pending,adopted,unavailable',
        ];
    }
}