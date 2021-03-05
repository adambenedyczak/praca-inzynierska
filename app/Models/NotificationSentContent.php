<?php

namespace App\Models;

use App\Models\NotificationSent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NotificationSentContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications_sent_content';

    protected $fillable = [
        'object_id',
        'object_name',
        'object_type',
        'element_category_id',
        'element_category_name',
        'element_type_name',
        'element_expired_date',
        'notification_sent_id'
    ];

    public function notification_sent(){
        return $this->belongsTo('\App\Models\NotificationSent');
    }
}
