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

    /**
     * @var array
     */
    protected $fillable = ['teacher_id', 'student_id', 'type', 'start_time', 'lesson_time', 'status', 'module', 'comments', 'approved', 'activity_status', 'created', 'modified'];

}
