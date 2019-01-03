<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $booking_type
 * @property int $lesson_type
 * @property int $user_id
 * @property int $student_id
 * @property int $city_id
 * @property string $start_time
 * @property string $end_time
 * @property string $note
 * @property string $status
 * @property string $g_cal_id
 * @property string $created
 * @property string $modified
 */
class SystemBooking extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = TBL_SYSTEM_BOOKINGS;

    /**
     * @var array
     */
    protected $fillable = ['booking_type', 'lesson_type', 'user_id', 'student_id', 'city_id', 'start_time', 'end_time', 'note', 'status', 'g_cal_id', 'created', 'modified'];

    public static function getUserNextBooking($userId)
    {
        $booking = array();
        $currentDate    = date('Y-m-d H:i',time());

        /*$sql = 'SELECT CONCAT_WS(  " ", `Booking`.`date`, SUBSTRING_INDEX( `BookingTrack`.`time_slot`,  "-", "1" ) ) AS book_date, `Booking`.`id` 
            FROM `bookings` AS `Booking` INNER JOIN `booking_tracks` AS `BookingTrack` 
            ON (`Booking`.`id` = `BookingTrack`.`booking_id`)  WHERE `student_id` = "'.$userId.'" 
            AND CONCAT_WS(  " ", `Booking`.`date`, SUBSTRING_INDEX( `BookingTrack`.`time_slot`,  "-", 1 ) ) >= "'.$currentDate.'"   
            ORDER BY `Booking`.`date` ASC  LIMIT 1';*/
        $systemBooking = SystemBooking::select('*')
                    ->where('student_id',$userId)
                    ->where('status','pending')
                    ->where('start_time','>=',$currentDate)
                    ->orderBy('start_time')
                    ->first();
        if($systemBooking)
        {
            $booking = $systemBooking;
        }

        ///$bookings = \DB::select($sql);
        /*$bookings = Booking::selectRaw('CONCAT_WS(  " ", '.TBL_BOOKINGS.'.date, SUBSTRING_INDEX( '.TBL_BOOKING_TRACKS.'.time_slot,  "-", 1 ) ) as book_date')
        ->join(TBL_BOOKING_TRACKS, TBL_BOOKING_TRACKS.'.booking_id', TBL_BOOKINGS.'.id')

        ->where(\DB::raw('CONCAT_WS( " ", `bookings`.`date`, SUBSTRING_INDEX( `booking_tracks`.`time_slot`,  '-', 1 ) )'), '>=', $currentDate)
        ->where(TBL_BOOKING_TRACKS.'.student_id', $userId)
        ->orderBy(TBL_BOOKINGS.'.date')
        ->first();*/
        return $booking;
    }
    public static function getUserTotalBooking($userId)
    {
        return SystemBooking::where('student_id',$userId)->count();
    }

    public static function notYetPaidservices($user)
    {
        $currentDate    = date('Y-m-d H:i:s',time());

        $systemBooking = SystemBooking::where('student_id',$user->id)
                ->where('status', '!=', 'delete')
                ->where('status', '!=', 'approved')
                ->where('status', '!=', 'unapproved')
                //->where('start_time', '>=',$currentDate)
                ->orderBy('start_time')
                ->get();

        return $systemBooking;
            
    }
}
