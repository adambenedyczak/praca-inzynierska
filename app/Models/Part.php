<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Part extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parts';

    protected $fillable = [
        'name',
        'serial_number',
        'manufacturer',
        'note',
        'objects_id',
        'part_type_id'
    ];

    public function object(){
        $this->hasOne('\App\Models\ObjectModel');
    }

    public function part_type(){
        $this->hasOne('\App\Models\PartType');
    }

    public function parts_date_type(){
        $this->hasMany('\App\Models\PartDateType');
    }
}
