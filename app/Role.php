<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable = [
       'name', 
    ];

    /**
     * A role has one user
     *
     * @return object
     */
    public function user()
    {
    	return $this->hasOne('App\User');
    }
}
