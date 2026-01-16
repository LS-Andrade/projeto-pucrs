<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationalContentRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\EducationalContent::class);
    }

    public function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }
}