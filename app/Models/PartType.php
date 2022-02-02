<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parts_type';

    protected $fillable = [
        'name'
    ];

    public function elements_typeable()
    {
        return $this->morphMany(Element::class, 'elements_typeable');
    }
}
