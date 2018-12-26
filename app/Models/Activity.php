<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $from_id
 * @property int $to_id
 * @property string $action
 * @property string $data
 * @property string $created
 * @property string $modified
 */
class Activity extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['from_id', 'to_id', 'action', 'data', 'created', 'modified'];

}
