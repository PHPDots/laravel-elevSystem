<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $slug
 * @property string $address
 * @property string $color
 * @property string $created
 * @property string $modified
 * @property AreaTimeSlot[] $areaTimeSlots
 * @property Booking[] $bookings
 */
class Area extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'address', 'color', 'created', 'modified'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function areaTimeSlots()
    {
        return $this->hasMany('App\Models\AreaTimeSlot');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking', 'area_slug', 'slug');
    }
}
