<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Animal;

class AnimalPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'protector']);
    }

    public function update(User $user, Animal $animal)
    {
        return $user->role === 'admin' || $animal->organization->users->contains($user);
    }

    public function delete(User $user, Animal $animal)
    {
        return $user->role === 'admin' || $animal->organization->users->contains($user);
    }
}
