<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'phone', 'email',
        'address', 'city', 'state', 'created_by', 'updated_by',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot(['created_by', 'updated_by']);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
}
