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
        'name',
        'file_path'
    ];

    public function parts(){
        $this->hasMany('\App\Models\Part');
    }
}
