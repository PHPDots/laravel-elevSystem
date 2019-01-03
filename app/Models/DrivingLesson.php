<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $teacher_id
 * @property integer $student_id
 * @property string $type
 * @property string $start_time
 * @property string $lesson_time
 * @property string $status
 * @property string $module
 * @property string $comments
 * @property string $approved
 * @property string $activity_status
 * @property string $created
 * @property string $modified
 */
class DrivingLesson extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $table = TBL_DRIVING_LESSONS;
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    /**
     * @var array
     */
    protected $fillable = ['teacher_id', 'student_id', 'type', 'start_time', 'lesson_time', 'status', 'module', 'comments', 'approved', 'activity_status', 'created', 'modified'];

    public static function getDrivingLessonForFinace($user)
    {
        $data = array();

        $drivingLessons = DrivingLesson::where('student_id',$user->id)
        /*->where(function ($drivingLessons){
            $drivingLessons->where('type', 'driving');
            $drivingLessons->whereNull('status');
        })
        ->where(function ($drivingLessons){
            $drivingLessons->where('type', 'test');
            $drivingLessons->where('status','confirmed');
        })*/
        ->get();
        if($drivingLessons)
        {
            foreach ($drivingLessons as $key => $value)
            {
                $data[$value->student_id][$value->id] = [
                    'id' => $value->id,
                    'teacher_id' => $value->teacher_id,
                    'student_id' => $value->student_id,
                    'type' => $value->type,
                    'start_time' => $value->start_time,
                    'lesson_time' => $value->lesson_time,
                    'status' => $value->status, 
                    'module' => $value->module,
                    'comments' => $value->comments, 
                    'approved' => $value->approved,
                    'activity_status' => $value->activity_status, 
                    'created' => $value->created,
                    'modified' => $value->modified,
                ];
            }
        }
        return $data;
    }
}
