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
    protected $table = 'systembookings';

    /**
     * @var array
     */
    protected $fillable = ['booking_type', 'lesson_type', 'user_id', 'student_id', 'city_id', 'start_time', 'end_time', 'note', 'status', 'g_cal_id', 'created', 'modified'];

}
