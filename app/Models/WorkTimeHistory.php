<?php

namespace App\Models;
use App\Observers\WorkTimeHistoriesObserver;

use App\Models\ObjectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WorkTimeHistory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'work_time_histories';

    protected $fillable = [
        'object_id',
        'value'  
    ];

    public function object(){
        return $this->belongsTo('\App\Models\ObjectModel');
    }
}
