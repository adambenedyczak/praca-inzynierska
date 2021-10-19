<?php

namespace App\Models;

use App\Models\Element;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detail extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'details';

    protected $fillable = [
        'elements_id',
        'detail_ownerable_type',
        'detail_ownerable_id',
        'detail_typeable_type',
        'detail_typeable_id',
        'own_name',
        'value'  
    ];

    public function detail_ownerable(){
        return $this->morphTo();
    }

    public function detail_typeable(){
        return $this->morphTo();
    }
}
