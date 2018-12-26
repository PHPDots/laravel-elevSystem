<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $email
 * @property string $template
 * @property string $data
 * @property int $priority
 * @property string $timestamp
 * @property string $status
 */
class EmailQueue extends Model
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
    protected $fillable = ['email', 'template', 'data', 'priority', 'timestamp', 'status'];

}
