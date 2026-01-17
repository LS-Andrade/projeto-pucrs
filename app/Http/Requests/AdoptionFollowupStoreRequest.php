<?php

namespace App\Http\Requests;

use App\Models\AdoptionFollowup;
use Illuminate\Foundation\Http\FormRequest;

class AdoptionFollowupStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', AdoptionFollowup::class);
    }

    public function rules(): array
    {
        return [
            'adoption_id' => 'required|exists:adoptions,id',
            'notes'       => 'required|string',
            'visit_date'  => 'required|date',
        ];
    }
}
