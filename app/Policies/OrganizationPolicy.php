<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Organization;

class OrganizationPolicy
{
    public function create(User $user)
    {
        return in_array($user->role, ['admin', 'protector']);
    }

    public function update(User $user, Organization $organization)
    {
        return $user->role === 'admin' || $organization->users->contains($user);
    }

    public function delete(User $user, Organization $organization)
    {
        return $user->role === 'admin';
    }
}