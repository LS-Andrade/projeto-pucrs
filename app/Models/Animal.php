<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'species', 'breed', 'gender', 'birth_date', 'age',
        'size', 'color', 'description', 'is_castrated', 'is_vaccinated',
        'health_status', 'status', 'organization_id',
        'created_by', 'updated_by',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'is_castrated' => 'boolean',
        'is_vaccinated' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function photos()
    {
        return $this->hasMany(AnimalPhoto::class);
    }
    
    public function mainPhoto()
    {
        return $this->hasOne(AnimalPhoto::class)->where('is_main', true);
    }

    public function adoptions()
    {
        return $this->hasMany(Adoption::class);
    }
}
