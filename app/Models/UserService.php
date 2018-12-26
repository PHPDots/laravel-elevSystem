<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property string $debtor_registration_id
 * @property string $posting_date
 * @property string $qty
 * @property string $price
 * @property string $total_price
 * @property string $description
 * @property string $created_at
 */
class UserService extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user_id', 'debtor_registration_id', 'posting_date', 'qty', 'price', 'total_price', 'description', 'created_at'];

}
