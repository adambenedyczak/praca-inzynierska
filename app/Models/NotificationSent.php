<?php

namespace App\Models;

use App\Models\NotificationSentContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationSent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications_sent';

    protected $fillable = [
        'user_id',
        'email',
        'when_sent'
    ];

    public function notifications_sent_contents(){
        return $this->hasMany('\App\Models\NotificationSentContent');
    }
}
