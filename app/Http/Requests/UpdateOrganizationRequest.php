<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('organization'));
    }

    public function rules()
    {
        return [
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'email' => 'sometimes|email',
            'phone' => 'nullable|string',
            'city' => 'sometimes|string',
            'state' => 'sometimes|string|max:2',
        ];
    }
}