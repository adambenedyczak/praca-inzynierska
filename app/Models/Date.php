<?php

namespace App\Models;

use App\Models\Element;
use App\Models\DateType;
use App\Models\NotificationList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Date extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'date';

    protected $fillable = [
        'elements_id',
        'date_type_id',
        'date',
        'work_time_value'  
    ];

    public function date_type(){
        return $this->belongsTo('\App\Models\DateType');
    }

    public function element(){
        return $this->belongsTo('\App\Models\Element');
    }

    public function notifications_list(){
        return $this->hasMany('\App\Models\NotificationList');
    }
}
