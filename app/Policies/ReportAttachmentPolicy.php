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
        // Qualquer usuario autenticado pode criar; regras adicionais ficam na camada de servico/controlador
        return (bool) $user;
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
