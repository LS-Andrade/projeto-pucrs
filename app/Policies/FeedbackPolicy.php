<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Feedback;

class FeedbackPolicy
{
    public function viewAny(User $user)
    {
        return $user->role === 'admin';
    }
}
