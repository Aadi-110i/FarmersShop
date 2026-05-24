<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerRequest extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'quantity',
        'urgency',
        'notes',
        'status',
        'fulfilled_by',
    ];

    /**
     * Get the farmer who created the request.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the supplier who fulfilled the request.
     */
    public function supplier()
    {
        return $this->belongsTo(User::class, 'fulfilled_by');
    }
}
