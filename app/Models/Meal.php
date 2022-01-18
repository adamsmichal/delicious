<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'restaurant_id',
        'photo',
        'description',
        'preparation_time',
        'is_active'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
