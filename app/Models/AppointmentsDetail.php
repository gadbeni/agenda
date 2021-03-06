<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AppointmentsDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'appointment_id', 'assistant_id', 'start', 'finish'
    ];

    public function assistant(){
        return $this->belongsTo(Assistant::class, 'assistant_id');
    }
}
