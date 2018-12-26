<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $from_date
 * @property string $city
 * @property int $discount
 * @property string $created
 * @property string $modifed
 */
class Discount extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['from_date', 'city', 'discount', 'created', 'modifed'];

}
