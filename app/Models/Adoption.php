<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Adoption extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'animal_id', 'adopter_id', 'status', 'motivation',
        'created_by', 'updated_by',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function adopter()
    {
        return $this->belongsTo(User::class, 'adopter_id');
    }

    public function followups()
    {
        return $this->hasMany(AdoptionFollowup::class);
    }
}
