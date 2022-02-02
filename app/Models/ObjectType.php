<?php

namespace App\Models;

use App\Models\ObjectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'objects_type';

    protected $fillable = [
        'name'
    ];

    public function objects()
    {
        return $this->hasMany('\App\Models\ObjectModel');
    }
}
