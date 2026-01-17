<?php

namespace App\Http\Requests;

use App\Models\AnimalPhoto;
use Illuminate\Foundation\Http\FormRequest;

class AnimalPhotoUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('animal_photo'));
    }

    public function rules(): array
    {
        return [
            'photo'   => 'nullable|image|max:2048',
            'is_main' => 'boolean',
        ];
    }
}
