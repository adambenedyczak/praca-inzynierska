<?php

namespace App\Models;

use App\Models\MessageContent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SentMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'sent_messages';

    protected $fillable = [
        'user_id',
        'email',
        'when_sent'
    ];

    public function messages_content()
    {
        return $this->hasMany('\App\Models\MessageContent');
    }
}
