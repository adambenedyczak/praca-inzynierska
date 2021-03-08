<?php

namespace App\Models;

use App\Models\ObjectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkTimeUnit extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'work_time_units';

    protected $fillable = [
        'name',
        'short'  
    ];

    public function objects(){
        return $this->hasMany('\App\Models\ObjectModel');
    }
}
