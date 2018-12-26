<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $mobileno
 * @property string $template
 * @property string $data
 * @property int $priority
 * @property string $timestamp
 * @property string $status
 */
class SmsQueue extends Model
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
    protected $fillable = ['mobileno', 'template', 'data', 'priority', 'timestamp', 'status'];

}
