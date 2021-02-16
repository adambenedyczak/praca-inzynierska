<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Overview extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'overviews';

    protected $fillable = [
        'date',
        'mileage',
        'moto_hours',
        'note',
        'objects_id',
        'overviews_date_type'
    ];

    public function object(){
        $this->hasOne('\App\Models\ObjectModel');
    }

    public function overview_date_type(){
        $this->hasOne('\App\Models\OverviewDateType');
    }
}
