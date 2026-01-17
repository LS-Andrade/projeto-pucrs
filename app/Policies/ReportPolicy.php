<?php

namespace App\Policies;

use App\Models\Report;
use App\Models\User;

class ReportPolicy
{
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'manager', 'staff']);
    }

    public function view(User $user, Report $report): bool
    {
        return $user->role === 'admin' ||
               $report->reporter_id === $user->id ||
               $report->assigned_to === $user->id;
    }

    public function create(User $user): bool
    {
        return true;
    }

    public function update(User $user, Report $report): bool
    {
        return $user->role === 'admin' ||
               $report->assigned_to === $user->id;
    }

    public function delete(User $user, Report $report): bool
    {
        return $user->role === 'admin';
    }
}
