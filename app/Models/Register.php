<?php

namespace App\Models;

use App\Models\ObjectModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Register extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'registers';

    protected $fillable = [
        'objects_id',
        'work_time_value',
        'note',
        'done_date'
    ];

    public function objects()
    {
        return $this->hasMany('\App\Models\ObjectModel');
    }
}
