<?php

namespace App\Http\Requests;

use App\Models\Organization;
use Illuminate\Foundation\Http\FormRequest;

class OrganizationUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('organization'));
    }

    public function rules(): array
    {
        return [
            'name'        => 'sometimes|string|max:255',
            'description' => 'nullable|string',
            'phone'       => 'nullable|string|max:20',
            'email'       => 'nullable|email',
            'address'     => 'nullable|string|max:255',
            'city'        => 'sometimes|string|max:100',
            'state'       => 'sometimes|string|size:2',
        ];
    }
}
