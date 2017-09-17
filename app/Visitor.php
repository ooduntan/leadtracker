<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'website_id',
        'ip_address',
        'category_id',
        'status',
        'country',
        'links',
        'postal_code',
        'company',
        'description',
        'source',
        'state',
        'first_seen',
        'last_seen',
    ];

    /**
     * A visitor has many websites
     *
     * @return object
     */
    public function websites()
    {
        return $this->hasMany('App\Website');
    }

    /**
     * A visitor has one category
     *
     * @return object
     */
    public function category()
    {
        return $this->hasOne('App\Category');
    }

     /**
     * A Visitor has many company.
     *
     * @return Object
     */
    public function companies()
    {
        return $this->hasMany('App\Company');
    }

    public function scopeFindOneById($query, $visitorId)
    {
        return $query
            ->where('id', $visitorId)
            ->first();
    }

    public function scopeFindAllById($query, $visitorId)
    {
        return $query
             ->where('id', $visitorId)
            ->get();
    }

    public function scopeFindAll($query)
    {
        return $query
            ->orderBy('id', 'ASC')
            ->get();
    }
}
