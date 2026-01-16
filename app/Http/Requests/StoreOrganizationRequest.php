<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrganizationRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('create', \App\Models\Organization::class);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
        ];
    }
}