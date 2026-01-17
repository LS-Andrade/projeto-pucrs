<?php

namespace App\Policies;

use App\Models\AdoptionFollowup;
use App\Models\User;

class AdoptionFollowupPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function view(User $user, AdoptionFollowup $followup): bool
    {
        return $this->update($user, $followup);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function update(User $user, AdoptionFollowup $followup): bool
    {
        return $user->role === 'admin' ||
               $followup->adoption->animal->organization->users->contains($user->id);
    }

    public function delete(User $user, AdoptionFollowup $followup): bool
    {
        return $user->role === 'admin';
    }
}
