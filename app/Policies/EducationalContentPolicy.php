<?php
namespace App\Policies;

use App\Models\User;
use App\Models\EducationalContent;

class EducationalContentPolicy
{
    public function create(User $user)
    {
        return $user->role === 'admin';
    }

    public function update(User $user, EducationalContent $content)
    {
        return $user->role === 'admin' || $content->author_id === $user->id;
    }

    public function delete(User $user, EducationalContent $content)
    {
        return $user->role === 'admin';
    }

    public function publish(User $user, EducationalContent $content)
    {
        return $user->role === 'admin';
    }
}