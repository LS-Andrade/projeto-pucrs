<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalPhoto extends Model
{
    use HasFactory;

    protected $table = 'animal_photo';

    protected $fillable = [
        'animal_id', 'photo', 'is_main',
        'created_by', 'updated_by',
    ];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}
