<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdoptionFollowup extends Model
{
    use HasFactory;

    protected $fillable = [
        'adoption_id',
        'notes',
        'visit_date',
        'created_by'
    ];

    protected $casts = [
        'visit_date' => 'date'
    ];

    public function adoption()
    {
        return $this->belongsTo(Adoption::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}