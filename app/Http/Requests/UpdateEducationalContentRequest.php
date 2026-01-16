<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEducationalContentRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('content'));
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ];
    }
}