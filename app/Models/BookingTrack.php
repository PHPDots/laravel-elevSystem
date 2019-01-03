<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $booking_id
 * @property integer $track_id
 * @property string $time_slot
 * @property integer $student_id
 * @property integer $booking_user_id
 * @property string $number
 * @property boolean $release_track
 * @property string $status
 * @property boolean $is_edit
 * @property boolean $other_student
 * @property string $name
 * @property string $address
 * @property string $phone
 * @property string $date_of_birth
 * @property string $zip_code
 * @property string $city
 * @property string $track_status
 * @property string $recent_realeased_tracks
 * @property integer $course
 * @property integer $released_by
 * @property string $g_cal_id
 * @property string $created
 * @property string $modified
 * @property Track $track
 * @property Booking $booking
 */
class BookingTrack extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_BOOKING_TRACKS;

    /**
     * @var array
     */
    protected $fillable = ['booking_id', 'track_id', 'time_slot', 'student_id', 'booking_user_id', 'number', 'release_track', 'status', 'is_edit', 'other_student', 'name', 'address', 'phone', 'date_of_birth', 'zip_code', 'city', 'track_status', 'recent_realeased_tracks', 'course', 'released_by', 'g_cal_id', 'created', 'modified'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function track()
    {
        return $this->belongsTo('App\Models\Track');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function booking()
    {
        return $this->belongsTo('App\Models\Booking');
    }

    public static function userFinanceBooking($authUser)
    {
        $bookingIds = \App\Models\Booking::select('id');
        if($authUser->teacher_id != '')
            $bookingIds = $bookingIds->where('user_id',$authUser->teacher_id);
        else
            $bookingIds = $bookingIds->where('user_id',$authUser->id);
        $bookingIds = $bookingIds->groupBy('id')->get()->toArray();

        $bookingTracks = BookingTrack::whereIn('booking_id',$bookingIds)->get();
        return $bookingTracks;
    }
    
}
