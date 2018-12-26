<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $from
 * @property string $purpose
 * @property string $city
 * @property string $driving_type
 * @property string $created
 * @property string $modified
 */
class TeacherRegisterTime extends Model
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
    protected $fillable = ['user_id', 'type', 'from', 'purpose', 'city', 'driving_type', 'created', 'modified'];

}
