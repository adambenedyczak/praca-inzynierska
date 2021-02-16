<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OverviewDateType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'overviews_date_type';

    protected $fillable = [
        'name'        
    ];

    public function overviews(){
        $this->hasMany('\App\Models\Overview');
    }

}
