<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
       'name', 'description', 'user_id',
    ];

    public function visitor()
    {
        $this->belongsTo('App\Visitor');
    }

    public function scopeFindOneById($query, $categoryId)
    {
    	return $query
    	    ->where('id', $categoryId)
    	    ->first();
    }

    public function scopeFindAll($query)
    {
        return $query
            ->orderBy('name', 'ASC')
            ->get();
    }
}
