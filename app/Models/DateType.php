<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DateType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'date_type';

    protected $fillable = [
        'name' 
    ];

    public function dates(){
        return $this->hasMany('\App\Models\Date');
    }
}
