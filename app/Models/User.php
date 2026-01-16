<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_ADMIN = 'admin';
    public const ROLE_PROTECTOR = 'protector';
    public const ROLE_ADOPTER = 'adopter';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // RELACIONAMENTOS

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class);
    }

    public function educationalContents()
    {
        return $this->hasMany(EducationalContent::class, 'author_id');
    }
}
