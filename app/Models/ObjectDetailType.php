<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectDetailType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'object_details_type';

    protected $fillable = [
        'name'
    ];

    public function detail_typeable()
    {
        return $this->morphMany(Detail::class, 'detail_typeable');
    }
}
