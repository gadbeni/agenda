<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'user_id', 'topic', 'description', 'applicant', 'place', 'start', 'finish'
    ];

    public function assistants(){
        return $this->belongsToMany(Assistant::class, 'appointments_details', 'appointment_id', 'assistant_id')->withTimestamps();
    }

    public function details(){
        return $this->hasMany(AppointmentsDetail::class, 'appointment_id');
    }
}
