<?php

namespace App\Policies;

use App\Models\Adoption;
use App\Models\User;

class AdoptionPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function view(User $user, Adoption $adoption): bool
    {
        return $user->role === 'admin' ||
               $adoption->adopter_id === $user->id ||
               ($adoption->animal->organization->users->contains($user->id));
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['user', 'adopter']);
    }

    public function update(User $user, Adoption $adoption): bool
    {
        return $user->role === 'admin' ||
               ($user->role !== 'user' &&
                $adoption->animal->organization->users->contains($user->id));
    }

    public function delete(User $user, Adoption $adoption): bool
    {
        return $user->role === 'admin';
    }
}
