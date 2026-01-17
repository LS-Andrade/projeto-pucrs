<?php

namespace App\Http\Requests;

use App\Models\AdoptionFollowup;
use Illuminate\Foundation\Http\FormRequest;

class AdoptionFollowupUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('adoption_followup'));
    }

    public function rules(): array
    {
        return [
            'notes'      => 'sometimes|string',
            'visit_date' => 'sometimes|date',
        ];
    }
}
