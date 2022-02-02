<?php

namespace App\Models;

use App\Models\Detail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InsuranceDetailType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'insurance_details_type';

    protected $fillable = [
        'name'
    ];

    public function detail_typeable()
    {
        return $this->morphMany(Detail::class, 'detail_typeable');
    }
}
