<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $template
 * @property string $body
 */
class SmsTemplate extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['template', 'body'];

}
