<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PartDateType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'parts_date_type';

    protected $fillable = [
        'name'
    ];

    public function objects(){
        $this->hasMany('\App\Models\PartDate');
    }
}
