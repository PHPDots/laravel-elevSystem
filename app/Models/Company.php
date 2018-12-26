<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $nick_name
 * @property string $city_id
 * @property string $status
 * @property string $created
 * @property string $modified
 */
class Company extends Model
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
    protected $fillable = ['name', 'nick_name', 'city_id', 'status', 'created', 'modified'];

}
