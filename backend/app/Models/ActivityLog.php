<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'account_id',
        'action',
        'description',
    ];
    public function account () {
        return $this->belongsTo(Account::class);
    }
}
