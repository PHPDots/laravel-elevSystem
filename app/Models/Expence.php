<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expence extends Model
{
    protected $keyType = 'integer';
    protected $table = TBL_EXPENCES;

    /**
     * @var array
     */
    protected $fillable = ['type', 'date', 'price', 'number', 'student_id', 'tax'];
}
