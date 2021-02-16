<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartDate extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parts_date';

    protected $fillable = [
        'date',
        'mileage',
        'moto_hours',
        'parts_date_type',
        'parts_id'        
    ];

    public function object(){
        $this->hasOne('\App\Models\ObjectModel');
    }

    public function date_type(){
        $this->hasOne('\App\Models\PartDateType');
    }
}
