<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationRules extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications_rules';

    protected $fillable = [
        'parts_notifications',
        'overviews_notifications',
        'insurances_notifications',
    ];

    public function email(){
        $this->hasOne('\App\Models\EmailAdress');
    }

}
