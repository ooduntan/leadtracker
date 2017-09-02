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
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    /**
     * A user has many website
     *
     * @return object
     */
    public function websites()
    {
        return $this->hasMany('App\Website');
    }

    /**
     * A user has many notes
     *
     * @return object
     */
    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    /**
     * A user has many activities
     *
     * @return object
     */
    public function activities()
    {
        return $this->hasMany('App\Activity');
    }
}
