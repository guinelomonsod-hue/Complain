<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticable;

class Account extends Model
{
    use Notifiable;
    protected $fillable = [
        'username',
        'email',
        'password',
        'role_id',
        'account_status',
    ];
    protected $hidden = ['password'];
    
    public function role() {
        return $this->belongsTo(Role::class);
    }
    public function citizen () {
        return $this->hasOne(Citizen::class);
    }
    public function staff () {
        return $this->hasMany(Staff::class);
    }
    public function activityLogs () {
        return $this->hasMany(ActivityLog::class);
    }
    public function complaintUpdates () {
        return $this->hasMany(ComplaintUpdate::class);
    }
    public function getJWtIdentifier() {
        return $this->getKey();
    }
    public function getJWTCustomClaims () {
        return [
            'role' => $this->role->role->role_name,

        ];
    }

}
