<?php

namespace App\Http\Requests;

use App\Models\AnimalPhoto;
use Illuminate\Foundation\Http\FormRequest;

class AnimalPhotoStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('create', AnimalPhoto::class);
    }

    public function rules(): array
    {
        return [
            'animal_id' => 'required|exists:animals,id',
            'photo'     => 'required|image|max:2048',
            'is_main'   => 'boolean',
        ];
    }
}
