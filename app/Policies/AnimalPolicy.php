<?php

namespace App\Policies;

use App\Models\Animal;
use App\Models\User;

class AnimalPolicy
{
    public function viewAny(User $user): bool
    {
        return true; // Público
    }

    public function view(User $user, Animal $animal): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function update(User $user, Animal $animal): bool
    {
        return $user->role === 'admin' ||
               ($user->role === 'manager' && 
                $animal->organization->users->contains($user->id));
    }

    public function delete(User $user, Animal $animal): bool
    {
        return $user->role === 'admin';
    }
}
