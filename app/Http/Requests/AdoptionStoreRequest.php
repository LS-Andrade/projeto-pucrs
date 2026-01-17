<?php

namespace App\Http\Requests;

use App\Models\Adoption;
use Illuminate\Foundation\Http\FormRequest;

class AdoptionStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Adoption::class);
    }

    public function rules(): array
    {
        return [
            'animal_id' => 'required|exists:animals,id',
            'motivation'=> 'nullable|string|max:1000',
        ];
    }
}
