<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'events_room_id', 'user_id', 'name', 'description', 'applicant', 'start', 'finish'
    ];

    function events_room(){
        return $this->belongsTo(EventsRoom::class, 'events_room_id')->withTrashed();
    }
}
