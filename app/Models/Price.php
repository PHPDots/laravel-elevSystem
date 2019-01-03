<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $from_date
 * @property string $type
 * @property string $name
 * @property string $area
 * @property int $price
 * @property string $created
 * @property string $modified
 */
class Price extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_PRICES;

    /**
     * @var array
     */
    protected $fillable = ['from_date', 'type', 'name', 'area', 'price', 'created', 'modified'];

    public static function getAreaPrices()
    {
        $areaPrices = array();
        $areaPricesData = Price::where('type','area')->get();
        if($areaPricesData)
        {
            foreach ($areaPricesData as $key => $value) {
                $areaPrices[$value->area][$value->from_date] = [
                    'id' => $value->id,
                    'from_date' => $value->from_date,
                    'type' => $value->type,
                    'name' => $value->name,
                    'area' => $value->area,
                    'price' => $value->price,
                    'created' => $value->created,
                    'modified' => $value->modified,
                ];
            }
        }
        return $areaPrices;

    }
    public static function getOtherPrices()
    {
        $otherPrices = array();
        $otherPricesData  = Price::where('type','!=','area')->get();
        if($otherPricesData)
        {
            foreach ($otherPricesData as $key => $value)
            {
                $otherPrices[$value->type][$value->from_date] = [
                    'id' => $value->id,
                    'from_date' => $value->from_date,
                    'type' => $value->type,
                    'name' => $value->name,
                    'area' => $value->area,
                    'price' => $value->price,
                    'created' => $value->created,
                    'modified' => $value->modified,
                ];
            }
        }
        return $otherPrices;
    }

}
