<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComplaintUpdate extends Model
{
    protected $fillable = [
        'complaint_id',
        'account_id',
        'status',
        'remarks',
        'update_date'
    ];
    public function complaint () {
        return $this->belongsTo(Complaint::class);
    }
    public function account () {
        return $this->belongsTo(Account::class);
    }
}
