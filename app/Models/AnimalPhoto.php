<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AnimalPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'photo_path',
        'is_main'
    ];

    protected $casts = [
        'is_main' => 'boolean'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }
}