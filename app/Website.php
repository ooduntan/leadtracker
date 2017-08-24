<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
	protected $fillable = [
        'user_id',
        'domain',
        'status',
    ];

    /**
     * A website belongs to one user.
     *
     * @return Object
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A website belongs to visitor
     *
     * @return object
     */
    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
}
