<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Adoption;

class AdoptionPolicy
{
    public function view(User $user, Adoption $adoption)
    {
        return $user->role === 'admin'
            || $adoption->adopter_id === $user->id
            || $adoption->animal->organization->users->contains($user);
    }

    public function approve(User $user, Adoption $adoption)
    {
        return in_array($user->role, ['admin', 'protector'])
            && $adoption->animal->organization->users->contains($user);
    }

    public function reject(User $user, Adoption $adoption)
    {
        return $this->approve($user, $adoption);
    }

    public function complete(User $user, Adoption $adoption)
    {
        return $this->approve($user, $adoption);
    }
}