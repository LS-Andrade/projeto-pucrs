<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'animal_description' => 'required|string',
            'location' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string|max:2',
        ];
    }
}