<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;

class ReportUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('report'));
    }

    public function rules(): array
    {
        return [
            'status'       => 'required|in:pending,in_progress,resolved,canceled',
            'assigned_to'  => 'nullable|exists:users,id',
        ];
    }
}
