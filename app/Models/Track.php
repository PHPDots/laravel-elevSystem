<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $area_id
 * @property string $status
 * @property string $created
 * @property string $modified
 * @property BookingTrack[] $bookingTracks
 */
class Track extends Model
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
    protected $fillable = ['name', 'area_id', 'status', 'created', 'modified'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingTracks()
    {
        return $this->hasMany('App\Models\BookingTrack');
    }
}
