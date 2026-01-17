<?php

namespace App\Http\Requests;

use App\Models\ReportAttachment;
use Illuminate\Foundation\Http\FormRequest;

class ReportAttachmentUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('report_attachment'));
    }

    public function rules(): array
    {
        return [
            'file' => 'nullable|file|max:5120',
        ];
    }
}
