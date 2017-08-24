<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'confirmed', 'confirmation_code', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * A user belongs to a role
     *
     * @return object
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
     * A user has many comapanies
     *
     * @return object
     */
    public function company()
    {
        return $this->hasMany('App\Company');
    }

    /**
     * A user has many website
     *
     * @return object
     */
    public function website()
    {
        return $this->hasMany('App\Website');
    }
}
