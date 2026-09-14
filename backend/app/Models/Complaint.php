<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    protected $fillable = [
        'citizen_id',
        'department_id',
        'category_id',
        'priority_id',
        'assigned_staff_id',
        'subject',
        'description',
        'location',
        'status',
        'date_submitted',
        'date_resolved'
    ];
    public function citizen () {
        return $this->belongsTo(Citizen::class);
    }
    public function assignedstaff () {
        return $this->belongsTo(Staff::class, 'assigned_staff_id');
    }
    public function department () {
        return $this->belongsTo(Department::class);
    }
    public function updates () {
        return $this->hasMany(ComplaintUpdate::class);
    }
    public function feedback () {
        return $this->hasOne(Feedback::class);
    }
    public function category () {
        return $this->belongsTo(Category::class);
    }
    public function priority () {
        return $this->belongsTo(Priorities::class);
    }
    public function attachment () {
        return $this->hasMany(Attachment::class);
    }
}
