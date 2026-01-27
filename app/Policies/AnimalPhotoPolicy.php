<?php

namespace App\Policies;

use App\Models\AnimalPhoto;
use App\Models\User;

class AnimalPhotoPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, AnimalPhoto $animalPhoto): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function update(User $user, AnimalPhoto $animalPhoto): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function delete(User $user, AnimalPhoto $animalPhoto): bool
    {
        return $user->role === 'admin';
    }
}