<?php

namespace App\Policies;

use App\Models\Content;
use App\Models\User;

class ContentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, Content $content): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function update(User $user, Content $content): bool
    {
        return $user->role === 'admin' ||
               $content->author_id === $user->id;
    }

    public function delete(User $user, Content $content): bool
    {
        return $user->role === 'admin';
    }
}
