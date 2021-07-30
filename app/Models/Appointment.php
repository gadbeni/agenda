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
        'topic', 'description', 'applicant', 'place', 'start', 'finish'
    ];

    public function details(){
        return $this->hasMany(AppointmentsDetail::class, 'appointment_id');
    }
}
