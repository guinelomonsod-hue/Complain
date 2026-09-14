<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = [
        'account_id',
        'first_name' ,
        'last_name',
        'contact_number',
        'address'
        ];
    
        public function account () {
            return $this->belongsTo(Account::class);
        }
        public function complaints () {
            return $this->hasMany(Complaint::class);
        }
        public function feedback () {
            return $this->hasMany(Feedback::class);
        }
}
