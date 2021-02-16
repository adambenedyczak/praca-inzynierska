<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Insurance extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'insurances';

    protected $fillable = [
        'date',
        'note',
        'objects_id',
        'insurances_date_type'     
    ];

    public function object(){
        $this->hasOne('\App\Models\ObjectModel');
    }

    public function insurance_date_type(){
        $this->hasOne('\App\Models\InsuranceDateType');
    }
}
