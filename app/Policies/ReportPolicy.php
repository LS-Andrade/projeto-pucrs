<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Report;

class ReportPolicy
{
    public function view(User $user, Report $report)
    {
        return $user->role === 'admin'
            || $report->assigned_to === $user->id
            || $report->reporter_id === $user->id;
    }

    public function update(User $user, Report $report)
    {
        return $user->role === 'admin' || $report->assigned_to === $user->id;
    }

    public function assign(User $user, Report $report)
    {
        return in_array($user->role, ['admin', 'protector']);
    }

    public function resolve(User $user, Report $report)
    {
        return $this->update($user, $report);
    }

    public function dismiss(User $user, Report $report)
    {
        return $user->role === 'admin';
    }
}