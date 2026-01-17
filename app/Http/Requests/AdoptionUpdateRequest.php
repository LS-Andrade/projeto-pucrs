<?php

namespace App\Http\Requests;

use App\Models\Adoption;
use Illuminate\Foundation\Http\FormRequest;

class AdoptionUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('adoption'));
    }

    public function rules(): array
    {
        return [
            'status'    => 'required|in:pending,approved,rejected,completed',
            'motivation'=> 'nullable|string|max:1000',
        ];
    }
}
