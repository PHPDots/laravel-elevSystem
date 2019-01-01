<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property string $area_slug
 * @property string $type
 * @property string $full_description
 * @property string $date
 * @property int $on_behalf
 * @property integer $co_teacher
 * @property integer $course
 * @property integer $reference
 * @property boolean $reminder_sent
 * @property int $second_reminder_sent
 * @property int $third_reminder_sent
 * @property string $created
 * @property string $modified
 * @property User $user
 * @property Area $area
 * @property BookingTrack[] $bookingTracks
 */
class Booking extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_BOOKINGS;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'area_slug', 'type', 'full_description', 'date', 'on_behalf', 'co_teacher', 'course', 'reference', 'reminder_sent', 'second_reminder_sent', 'third_reminder_sent', 'created', 'modified'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo('App\Models\Area', 'area_slug', 'slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookingTracks()
    {
        return $this->hasMany('App\Models\BookingTrack');
    }

    public static function getUserNextBooking($authUser)
    {
        $currentDate    = date('Y-m-d H:i',time());

        /*$sql = 'SELECT CONCAT_WS(  " ", `Booking`.`date`, SUBSTRING_INDEX( `BookingTrack`.`time_slot`,  "-", "1" ) ) AS book_date, `Booking`.`id` 
            FROM `bookings` AS `Booking` INNER JOIN `booking_tracks` AS `BookingTrack` 
            ON (`Booking`.`id` = `BookingTrack`.`booking_id`)  WHERE `student_id` = "'.$authUser.'" 
            AND CONCAT_WS(  " ", `Booking`.`date`, SUBSTRING_INDEX( `BookingTrack`.`time_slot`,  "-", 1 ) ) >= "'.$currentDate.'"   
            ORDER BY `Booking`.`date` ASC  LIMIT 1';*/
        $booking = SystemBooking::select('*')
                    ->where('student_id',$authUser)
                    ->where('status','pending')
                    ->where('start_time','>=',$currentDate)
                    ->orderBy('start_time')
                    ->first();

        ///$bookings = \DB::select($sql);
        /*$bookings = Booking::selectRaw('CONCAT_WS(  " ", '.TBL_BOOKINGS.'.date, SUBSTRING_INDEX( '.TBL_BOOKING_TRACKS.'.time_slot,  "-", 1 ) ) as book_date')
        ->join(TBL_BOOKING_TRACKS, TBL_BOOKING_TRACKS.'.booking_id', TBL_BOOKINGS.'.id')

        ->where(\DB::raw('CONCAT_WS( " ", `bookings`.`date`, SUBSTRING_INDEX( `booking_tracks`.`time_slot`,  '-', 1 ) )'), '>=', $currentDate)
        ->where(TBL_BOOKING_TRACKS.'.student_id', $authUser)
        ->orderBy(TBL_BOOKINGS.'.date')
        ->first();*/
        return $booking;
    }
}
