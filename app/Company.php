<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	protected $fillable = [
        'category_id',
        'contact_name',
        'contact_email',
        'visitor_id',
        'company_name',
        'company_billing_email',
        'street',
        'country',
        'postal_code',
        'website',
        'city',
        'vat_id',
    ];

    /**
     * A company belongs to one user.
     *
     * @return Object
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * A company belongs to a visitor.
     *
     * @return Object
     */
    public function visitor()
    {
        return $this->belongsTo('App\Visitor');
    }
}
