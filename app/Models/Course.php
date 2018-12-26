<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property integer $price
 * @property string $teacher_time
 * @property string $activity_number
 * @property string $area
 * @property string $pre_selected
 * @property string $created
 * @property string $modified
 */
class Course extends Model
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
    protected $fillable = ['name', 'price', 'teacher_time', 'activity_number', 'area', 'pre_selected', 'created', 'modified'];

}
