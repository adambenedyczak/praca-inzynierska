<?php

namespace App\Models;

use App\Models\NotificationList;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use SoftDeletes, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function objects()
    {
        return $this->hasMany('\App\Models\ObjectModel');
    }

    public function emails()
    {
        return $this->hasMany('\App\Models\EmailAdress');
    }

    public function notification_rules()
    {
        return $this->hasOne('\App\Models\NotificationRules');
    }

    public function notifications()
    {
        return $this->hasMany('\App\Models\Notifications');
    }
}
