<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'phone', 'role', 'is_active',
        'created_by', 'updated_by',
    ];

    protected $hidden = [
        'password',
    ];

    // RELACIONAMENTOS

    public function organizations()
    {
        return $this->belongsToMany(Organization::class)
            ->withTimestamps()
            ->withPivot(['created_by', 'updated_by']);
    }

    public function animalsCreated()
    {
        return $this->hasMany(Animal::class, 'created_by');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class, 'adopter_id');
    }

    public function contents()
    {
        return $this->hasMany(Content::class, 'author_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function assignedReports()
    {
        return $this->hasMany(Report::class, 'assigned_to');
    }

    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }
}
