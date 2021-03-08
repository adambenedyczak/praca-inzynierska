<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EventType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'events_type';

    protected $fillable = [
        'name' 
    ];

    public function events(){
        return $this->hasMany('\App\Models\Event');
    }
}
