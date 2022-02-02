<?php

namespace App\Models;

use App\Models\Element;
use App\Models\NotificationList;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ElementCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'elements_category';

    protected $fillable = [
        'name'
    ];

    public function elements()
    {
        return $this->hasMany('\App\Models\Element');
    }

    public function notifications_list()
    {
        return $this->hasMany('\App\Models\NotificationList');
    }
}
