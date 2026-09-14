<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $fillable = [
        'complaint_id',
        'citizen_id',
        'rating',
        'comment',
        'submitted_at'
    ];

    public function citizen () {
        return $this->belongsTo(Citizen::class);
    }
    public function complaint () {
        return $this->belongsTo(Complaint::class);
    }
}
