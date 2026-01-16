<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReportRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->route('report'));
    }

    public function rules()
    {
        return [
            'status' => 'required|in:open,assigned,resolved,dismissed',
        ];
    }
}