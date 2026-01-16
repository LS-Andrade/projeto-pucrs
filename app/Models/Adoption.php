<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adoption extends Model
{
    use HasFactory;

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'created_by',
        'animal_id',
        'status',
        'message',
    ];

    // RELACIONAMENTOS

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
