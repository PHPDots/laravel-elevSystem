<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $city_code
 * @property string $name
 * @property string $slug
 * @property int $fik
 */
class City extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_CITY;

    /**
     * @var array
     */
    protected $fillable = ['city_code', 'name', 'slug', 'fik'];

    public static function getUserCity($user)
    {
        $data = array();

        $student_number = $user->student_number;
        $city_id  = substr(trim($student_number), 2, -11);
        $city = City::where('city_code',$city_id)->first();
        if($city)
        {
            $data = $city;
        }
        return $data;    
    }
}
