<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $area
 * @property string $status
 * @property integer $activity_number
 * @property string $created
 * @property string $modified
 */
class ActivityNumber extends Model
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
    protected $fillable = ['type', 'area', 'status', 'activity_number', 'created', 'modified'];

}
