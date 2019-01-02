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

    public static function studentTotalBooking($userId)
    {
        $bookings = Booking::join(TBL_BOOKING_TRACKS,TBL_BOOKING_TRACKS.'.booking_id',TBL_BOOKINGS.'.id')
                ->where(TBL_BOOKING_TRACKS.'.student_id',$userId)
                ->count();
        return $bookings;
    }

    public static function studentNextBooking($userId)
    {
        $nextBooking = array();
        $booking = Booking::join(TBL_BOOKING_TRACKS,TBL_BOOKING_TRACKS.'.booking_id',TBL_BOOKINGS.'.id')
                ->where(TBL_BOOKING_TRACKS.'.student_id',$userId)
                ->where(TBL_BOOKINGS.'.date','>=',date('Y-m-d',time()))
                ->first();

        if($booking)
        {
            $timeSlot = explode('-',$booking->time_slot);
            if(is_array($timeSlot))
            {
              if($booking->date.' '.$timeSlot[0] >= date('Y-m-d H:i',time())) {
                    $nextBooking = $booking;
                }  
            } 
        }
        
        return $nextBooking;
    }
}
