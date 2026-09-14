<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['role' , 'role_description'];

    public function accounts () {
        return $this->hasMany(Account::class);
    }

    
}
