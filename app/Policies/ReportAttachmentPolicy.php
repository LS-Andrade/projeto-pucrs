<?php

namespace App\Policies;

use App\Models\ReportAttachment;
use App\Models\User;

class ReportAttachmentPolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }

    public function view(User $user, ReportAttachment $attachment): bool
    {
        return true;
    }

    public function create(User $user): bool
    {
        return $user->role === 'admin' ||
               $attachment->report->assigned_to === $user->id ||
               $attachment->report->reporter_id === $user->id;
    }

    public function update(User $user, ReportAttachment $attachment): bool
    {
        return $user->role === 'admin';
    }

    public function delete(User $user, ReportAttachment $attachment): bool
    {
        return $user->role === 'admin';
    }
}
