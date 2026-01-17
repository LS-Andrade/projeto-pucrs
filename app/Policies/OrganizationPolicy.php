<?php

namespace App\Policies;

use App\Models\Organization;
use App\Models\User;

class OrganizationPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function view(User $user, Organization $organization): bool
    {
        return $user->role === 'admin' || 
               $organization->users->contains($user->id);
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager']);
    }

    public function update(User $user, Organization $organization): bool
    {
        return $user->role === 'admin' || 
               $organization->users->contains($user->id);
    }

    public function delete(User $user, Organization $organization): bool
    {
        return $user->role === 'admin';
    }
}
