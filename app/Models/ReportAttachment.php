<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReportAttachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'report_id',
        'file_path',
        'file_type'
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }
}