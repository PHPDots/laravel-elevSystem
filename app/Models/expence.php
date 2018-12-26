<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $type
 * @property string $date
 * @property string $price
 * @property int $number
 * @property integer $student_id
 * @property int $tax
 */
class expence extends Model
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
    protected $fillable = ['type', 'date', 'price', 'number', 'student_id', 'tax'];

}
