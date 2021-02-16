<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceDateType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'insurances_date_type';

    protected $fillable = [
        'name'    
    ];

    public function insurances(){
        $this->hasMany('\App\Models\Insurance');
    }

}
