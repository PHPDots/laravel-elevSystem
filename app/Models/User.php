<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @property integer $id
 * @property string $role
 * @property integer $avatar_id
 * @property string $username
 * @property string $password
 * @property string $email_id
 * @property string $firstname
 * @property string $lastname
 * @property string $nick_name_user
 * @property string $nick_name_company
 * @property string $phone_no
 * @property string $status
 * @property string $activation_key
 * @property string $student_number
 * @property string $company
 * @property string $company_id
 * @property string $address
 * @property string $zip
 * @property string $city
 * @property string $other_phone_no
 * @property string $date_of_birth
 * @property int $balance
 * @property string $credit_max
 * @property string $available_balance
 * @property float $last_balance
 * @property string $last_entry_for_balance
 * @property integer $teacher_id
 * @property string $crm_id
 * @property string $assistent_id
 * @property boolean $handed_firstaid_papirs
 * @property string $firstaid_papirs_date
 * @property boolean $theory_test_passed
 * @property string $student_medical_profile
 * @property string $google_token
 * @property boolean $is_login_firsttime
 * @property int $is_completed
 * @property string $expiry_date
 * @property string $created
 * @property Role $role
 * @property Booking[] $bookings
 * @property TncUser[] $tncUsers
 */
class User extends Authenticatable
{
    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';
    protected $guard = "users";
    protected $table = TBL_USERS;
    
    const CREATED_AT = 'created';
    const UPDATED_AT = 'modified';

    /**
     * @var array
     */
    protected $fillable = ['role', 'avatar_id', 'username', 'password', 'email_id', 'firstname', 'lastname', 'nick_name_user', 'nick_name_company', 'phone_no', 'status', 'activation_key', 'student_number', 'company', 'company_id', 'address', 'zip', 'city', 'other_phone_no', 'date_of_birth', 'balance', 'credit_max', 'available_balance', 'last_balance', 'last_entry_for_balance', 'teacher_id', 'crm_id', 'assistent_id', 'handed_firstaid_papirs', 'firstaid_papirs_date', 'theory_test_passed', 'student_medical_profile', 'google_token', 'is_login_firsttime', 'is_completed', 'expiry_date', 'created'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role', 'role', 'slug');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tncUsers()
    {
        return $this->hasMany('App\Models\TncUser');
    }

    public static function getTeacher($student)
    {
        $teacher = User::where('id',$student->teacher_id)->first();
        return $teacher;
    }

    public static function studentFinanceCalculation($authUser)
    {
        $studentAmount = array();
        $students = \Auth::user();

//Area Prices
        $areaPrices = \App\Models\Price::getAreaPrices();
        $otherPrices = \App\Models\Price::getOtherPrices();

//Expences Calculation
        $expence  = \App\Models\Expence::where('student_id',$authUser->id)->get();

        if(count($expence))
        {
            foreach($expence as $key => $value)
            {
                $studentAmount[$key]    = array(
                    'name'              => ucfirst($authUser->firstname).' '.ucfirst($authUser->lastname),
                    'text'              => $value->type,
                    'date'              => $value->date,
                    'price'             => $value->price,
                    'count'             => $value->number,
                );         
            }
        }

// BookingTrack Calculation
        $studentArr = array();
        $bookingTracks = BookingTrack::userFinanceBooking($authUser);
        
        if(!empty($bookingTracks))
        {
            foreach($bookingTracks as $track)
            {
                if(!empty($track->student_id))
                {
                    if($track->student_id == $authUser->id)
                    {
                        $area_slug = $booking_date = '';
                        $bk = Booking::find($track->booking_id);
                        if($bk){
                            $area_slug = $bk->area_slug;
                            $booking_date = $bk->date;
                        }

                        $studentArr[$track->student_id][$track->booking_id] = array(
                            'booking_id'    => $track->booking_id,
                            'area'          => $area_slug,
                            'booking_date'  => $booking_date,
                        );
                    }
                }
            }
        }

        foreach($studentArr as $studentId => $bookings)
        {
            foreach($bookings as $booking)
            {
                if(isset($areaPrices[$booking['area']]))
                {
                    ksort($areaPrices[$booking['area']]);
                    $dateArray  = array_keys($areaPrices[$booking['area']]); 
                     
                    for($i=0;$i<count($dateArray);$i++){       

                        if(isset($dateArray[$i+1])){
                            if((strtotime(date('Y-m-d',strtotime($booking['booking_date']))) > strtotime($dateArray[$i+1]))){
                                echo 'yes';
                                $areaAmount  = $areaPrices[$booking['area']][$dateArray[$i+1]]['price']; 
                                print_r($areaAmount) ;                               
                            }else if((strtotime(date('Y-m-d',strtotime($booking['booking_date']))) >= strtotime($dateArray[$i]))
                                && (strtotime(date('Y-m-d',strtotime($booking['booking_date']))) < strtotime($dateArray[$i+1]))){                                                               
                                $areaAmount  = $areaPrices[$booking['area']][$dateArray[$i]]['price'];                                  
                            } 
                        }else if(count($dateArray) == 1){
                            $areaAmount  = $areaPrices[$booking['area']][$dateArray[$i]]['price']; 
                        }
                    }
                     
                    $studentAmount[] = array(
                        'booking_id'    => $booking['booking_id'],
                        'booking_date'  => $booking['booking_date'],
                        'user_id'       => $studentId,
                        'name'          => $students[$studentId]['firstname'].' '.$students[$studentId]['lastname'],
                        'area'          => $booking['area'],
                        'category'      => 'Booked Track',
                        'text'          => 'ManÃ¸vrebane, 4 lekt.',
                        'price'         => $areaAmount,
                        'date'          => date('d.m.Y',strtotime($booking['booking_date'])),
                        'count'         => 1
                    );
                }
            }
        }

// drivingLessons Calculation
        $drivingLessons = \App\Models\DrivingLesson::getDrivingLessonForFinace($authUser);

        foreach($drivingLessons as $studentId => $lessons)
        {
            foreach($lessons as $lessonId => $lesson)
            {
                if(isset($otherPrices[$lesson['type']]))
                {
                    ksort($otherPrices[$lesson['type']]);
                    $dateArray  = array_keys($otherPrices[$lesson['type']]);
                    for($i=0;$i<count($dateArray);$i=$i+2)
                    {
                        if(isset($dateArray[$i+1])){
                            if((strtotime(date('Y-m-d',strtotime($lesson['start_time']))) > strtotime($dateArray[$i+1]))){                                                              
                                $drivingAmount  = $otherPrices[$lesson['type']][$dateArray[$i+1]]['price']; 
                            }else if((strtotime(date('Y-m-d',strtotime($lesson['start_time']))) >= strtotime($dateArray[$i]))
                                    && (strtotime(date('Y-m-d',strtotime($lesson['start_time']))) < strtotime($dateArray[$i+1]))){                                                               
                                $drivingAmount  = $otherPrices[$lesson['type']][$dateArray[$i]]['price'];                                                            
                            }
                        }else if(count($dateArray) == 1){
                            $drivingAmount  = $otherPrices[$lesson['type']][$dateArray[$i]]['price'];    
                        }
                        
                        $studentAmount[] = array(
                            'lesson_id'     => $lessonId,
                            'user_id'       => $studentId,
                            'name'          => $students[$studentId]['firstname'].' '.$students[$studentId]['lastname'],
                            'area'          => '',
                            'category'      => 'KÃ¸retime',
                            'text'          => 'KÃ¸retime',
                            'price'         => $drivingAmount,
                            'date'          => date('d.m.Y',strtotime($lesson['start_time'])),
                            'count'         => 1
                        );
                    }
                }
            }
        }

//userServices Calculation
        $userServices = \App\Models\UserService::where('user_id',$authUser->id)->orderBy('posting_date')->groupBy('id')->get();
   
        if($userServices)
        {
            foreach ($userServices as $key => $userService)
            {
                $studentAmount[] = array(
                                'lesson_id'     => "",
                                'user_id'       => $userService->user_id,
                                'name'          => ucfirst($authUser->firstname).' '.ucfirst($authUser->lastname),
                                'area'          => '',
                                'category'      => $userService->description,
                                'text'          => $userService->description,
                                'price'         => number_format($userService->total_price,2),
                                'date'          => date('d.m.Y',strtotime($userService->posting_date)),
                                'count'         => round($userService->qty),
                            );
            }
        }

        return $studentAmount;
    }
}
