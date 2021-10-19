<?php

namespace App\Models;

use App\Models\Date;
use App\Models\Detail;
use App\Models\ObjectModel;
use App\Models\ElementCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Element extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'elements';

    protected $fillable = [
        'objects_id',
        'name',
        'elements_category_id',
        'elements_typeable_type',
        'elements_typeable_id'  
    ];

    public function elements_typeable(){
        return $this->morphTo();
    }

    public function element_category(){
        return $this->belongsTo(ElementCategory::class, 'elements_category_id');
    }

    public function events(){
        return $this->hasMany(Event::class);
    }
    public function detail_ownerable(){
        return $this->morphMany(Detail::class, 'detail_ownerable');
    }
    public function object_model(){
        return $this->belongsTo(ObjectModel::class);
    }
}
