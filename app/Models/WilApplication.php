<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class WilApplication extends Model
{
    protected $fillable = [
        'user_id',
        'id_number',
        'phone',
        'address',
        'institution',
        'student_number',
        'field_of_study',
        'year_of_study',
        'faculty',
        'status',
        'notes',
    ];

    // Belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Has many documents
    public function documents()
    {
        return $this->hasMany(Document::class, 'application_id');
    }

    // Has one payment
    public function payment()
    {
        return $this->hasOne(Payment::class, 'application_id');
    }
}