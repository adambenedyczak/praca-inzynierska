<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationRules extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications_rules';

    protected $fillable = [
        'email',
        'user_id',
        'parts_notifications',
        'overviews_notifications',
        'insurances_notifications'  
    ];

    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
}
