<?php

namespace App\Models;

use App\Models\User;
use App\Models\Element;
use App\Models\ObjectType;
use App\Models\WorkTimeUnit;
use App\Models\WorkTimeHistory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'objects_model';

    protected $fillable = [
        'name',
        'object_type_id',
        'user_id',
        'work_time_unit_id'  
    ];

    public function elements(){
        return $this->hasMany('\App\Models\Element');
    }
    public function work_time_histories(){
        return $this->hasMany('\App\Models\WorkTimeHistory');
    }
    public function work_time_unit(){
        return $this->belongsTo('\App\Models\WorkTimeUnit');
    }
    public function object_type(){
        return $this->belongsTo('\App\Models\ObjectType');
    }
    public function user(){
        return $this->belongsTo('\App\Models\User');
    }
    public function detail_ownerable(){
        return $this->morphMany(Detail::class, 'detail_ownerable');
    }
}
