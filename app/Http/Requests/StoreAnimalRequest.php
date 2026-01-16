<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimalRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\Animal::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'species' => 'required|in:dog,cat,other',
            'breed' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'age' => 'nullable|integer|min:0',
            'description' => 'nullable|string',
            'organization_id' => 'required|exists:organizations,id',
        ];
    }
}