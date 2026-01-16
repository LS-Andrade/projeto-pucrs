<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    public const STATUS_AVAILABLE = 'available';
    public const STATUS_PENDING = 'pending';
    public const STATUS_ADOPTED = 'adopted';

    protected $fillable = [
        'organization_id',
        'created_by',
        'name',
        'species',
        'breed',
        'gender',
        'size',
        'description',
        'is_vaccinated',
        'is_castrated',
        'status',
    ];

    protected $casts = [
        'is_vaccinated' => 'boolean',
        'is_castrated' => 'boolean',
    ];

    // RELACIONAMENTOS

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
