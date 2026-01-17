<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()->can('update', $this->route('user'));
    }

    public function rules(): array
    {
        return [
            'name'      => 'sometimes|string|max:255',
            'email'     => 'sometimes|email|unique:users,email,' . $this->route('user')->id,
            'password'  => 'nullable|string|min:8|confirmed',
            'phone'     => 'nullable|string|max:20',
            'role'      => 'sometimes|in:admin,manager,staff,user',
            'is_active' => 'boolean',
        ];
    }
}
