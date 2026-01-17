<?php

namespace App\Http\Requests;

use App\Models\ReportAttachment;
use Illuminate\Foundation\Http\FormRequest;

class ReportAttachmentStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', ReportAttachment::class);
    }

    public function rules(): array
    {
        return [
            'report_id' => 'required|exists:reports,id',
            'file'      => 'required|file|max:5120',
        ];
    }
}
