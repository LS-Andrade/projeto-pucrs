<?php

namespace App\Http\Requests;

use App\Models\Adoption;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdoptionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Adoption::class);
    }

    public function rules(): array
    {
        return [
            'animal_id' => [
                'required',
                Rule::exists('animals', 'id')->where(fn ($q) => $q->where('status', 'available')),
            ],
            'motivation'=> 'nullable|string|max:1000',
        ];
    }
}
