<?php

namespace App\Models;

use App\Models\User;
use App\Models\Event;
use App\Models\EmailAdress;
use App\Models\ElementCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'notifications';

    protected $fillable = [
        'event_id',
        'elements_category_id',
        'user_id',
        'send',
        'next_send',
        'work_time_value'
    ];

    public function element_category()
    {
        return $this->belongsTo(ElementCategory::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'events_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
