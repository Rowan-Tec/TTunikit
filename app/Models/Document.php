<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = [
        'application_id',
        'type',
        'file_path',
        'original_name',
        'mime_type',
        'file_size',
    ];

    // Belongs to an application
    public function application()
    {
        return $this->belongsTo(WilApplication::class, 'application_id');
    }
}