<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    protected $fillable = [
        'complaint_id',
        'file_name',
        'file_path',
        'uploaded_at'
    ];
    public function complaint () {
        return $this->belongsTo(Complaint::class);
    }
}
