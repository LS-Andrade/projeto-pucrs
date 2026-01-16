<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class EducationalContent extends Model
{
    use HasFactory;

    protected $fillable = [
        'created_by',
        'title',
        'slug',
        'content',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    // RELACIONAMENTOS

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // HOOK para gerar slug automaticamente se quiser
    protected static function booted()
    {
        static::creating(function ($content) {
            if (empty($content->slug)) {
                $content->slug = Str::slug($content->title);
            }
        });
    }
}
