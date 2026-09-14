<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $fillable = [
        'account_id',
        'department_id',
        'first_name',
        'last_name',
        'position'
    ];

    public function staff () {
        return $this->belongsTo(Account::class);
    }
    public function complaint () {
        return $this->hasMany(Complaint::class);
    }
    public function department () {
        return $this->hasMany(Department::class);
    }
}
