<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $DebitorRegistreringID
 * @property string $IsPosteret
 * @property string $PosteringsDato
 * @property string $DebitorNummer
 * @property string $Debet
 * @property string $Kredit
 * @property string $BilagsNummer
 * @property string $ModKontoID
 * @property string $created_at
 */
class LatestPayment extends Model
{
    /**
     * @var array
     */
    protected $table = TBL_LATEST_PAYMENTS;

    protected $fillable = ['DebitorRegistreringID', 'IsPosteret', 'PosteringsDato', 'DebitorNummer', 'Debet', 'Kredit', 'BilagsNummer', 'ModKontoID', 'created_at'];

    public static function getUserPayments($user)
    {
    	$data = array();
    	$student_number = $user->student_number;
    	$data = LatestPayment::where('DebitorNummer',$student_number)->get()->toArray();
    	return $data;
    }

}
