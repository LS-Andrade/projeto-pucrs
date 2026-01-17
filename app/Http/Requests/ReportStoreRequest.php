<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

class ReportStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', Report::class);
    }

    public function rules(): array
    {
        return [
            'animal_description' => 'required|string|max:1000',
            'location'           => 'required|string|max:255',
            'city'               => 'required|string|max:100',
            'state'              => 'required|string|size:2',
        ];
    }
}
