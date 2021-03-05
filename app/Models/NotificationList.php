<?php

namespace App\Models;

use App\Models\Date;
use App\Models\User;
use App\Models\EmailAdress;
use App\Models\ElementCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationList extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications_list';

    protected $fillable = [
        'date_id',
        'elements_category_id',
        'user_id',
        'send',
        'next_send',
        'work_time_value'  
    ];

    public function element_category(){
        return $this->belongsTo('\App\Models\ElementCategory');
    }

    public function date(){
        return $this->belongsTo('\App\Models\Date');
    }

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
