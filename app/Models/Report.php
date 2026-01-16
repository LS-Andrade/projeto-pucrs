<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public const STATUS_OPEN = 'open';
    public const STATUS_IN_PROGRESS = 'in_progress';
    public const STATUS_RESOLVED = 'resolved';

    protected $fillable = [
        'created_by',
        'title',
        'description',
        'location',
        'status',
    ];

    // RELACIONAMENTOS

    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
