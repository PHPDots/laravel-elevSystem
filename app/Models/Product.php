<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property int $activity_number
 * @property string $price
 * @property string $teacher_time
 * @property string $created
 * @property string $modifed
 */
class Product extends Model
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
    protected $fillable = ['name', 'activity_number', 'price', 'teacher_time', 'created', 'modifed'];

}
