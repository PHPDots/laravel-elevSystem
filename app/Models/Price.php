<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $from_date
 * @property string $type
 * @property string $name
 * @property string $area
 * @property int $price
 * @property string $created
 * @property string $modified
 */
class Price extends Model
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
    protected $fillable = ['from_date', 'type', 'name', 'area', 'price', 'created', 'modified'];

}
