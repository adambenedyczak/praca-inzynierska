<?php

namespace App\Models;

use App\Models\SentMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MessageContent extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'messages_content';

    protected $fillable = [
        'object_id',
        'object_name',
        'object_type_id',
        'element_category_id',
        'element_category_name',
        'element_type_name',
        'element_expired_date',
        'sent_messages_id'
    ];

    public function sent_message(){
        return $this->belongsTo('\App\Models\SentMessage');
    }
}
