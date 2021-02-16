<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ObjectModel extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'objects';

    protected $fillable = [
        'name',
        'plate',
        'serial_number',
        'object_type',
        'user_id'
    ];

    public function object_type(){
        $this->hasOne('\App\Models\ObjectType');
    }

    public function user(){
        $this->hasOne('\App\Models\User');
    }

    public function parts(){
        $this->hasMany('\App\Models\Part');
    }

    public function overviews(){
        $this->hasMany('\App\Models\Overview');
    }

    public function insurances(){
        $this->hasMany('\App\Models\Insurance');
    }
}
