<?php

namespace App\Http\Requests;

use App\Models\Animal;
use Illuminate\Foundation\Http\FormRequest;

class AnimalUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('animal'));
    }

    public function rules(): array
    {
        return [
            'name'             => 'sometimes|string|max:255',
            'species'          => 'sometimes|string|max:50',
            'breed'            => 'nullable|string|max:100',
            'gender'           => 'sometimes|in:male,female,unknown',
            'birth_date'       => 'nullable|date',
            'age'              => 'nullable|integer|min:0',
            'size'             => 'nullable|in:small,medium,large',
            'color'            => 'nullable|string|max:50',
            'description'      => 'nullable|string',
            'is_castrated'     => 'boolean',
            'is_vaccinated'    => 'boolean',
            'health_status'    => 'nullable|string|max:255',
            'status'           => 'sometimes|in:available,adopted,reserved',
            'organization_id'  => 'sometimes|exists:organizations,id',
        ];
    }
}
