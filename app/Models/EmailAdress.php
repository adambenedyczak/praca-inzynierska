<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmailAdress extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'emails_adress';

    protected $fillable = [
        'email',
        'enable_send',
        'user_id',
    ];

    public function notification_rule(){
        $this->hasOne('\App\Models\NotificationRule');
    }

    public function user(){
        $this->hasOne('\App\Models\User');
    }
}
