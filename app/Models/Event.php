<?php

namespace App\Models;

use App\Models\Element;
use App\Models\EventType;
use App\Models\Notification;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events';

    protected $fillable = [
        'element_id',
        'events_type_id',
        'expired_date',
        'done_date',
        'work_time_value'  
    ];

    public function event_type(){
        return $this->belongsTo('\App\Models\EventType');
    }

    public function element(){
        return $this->belongsTo('\App\Models\Element');
    }

    public function notifications(){
        return $this->hasMany('\App\Models\Notification');
    }
}
