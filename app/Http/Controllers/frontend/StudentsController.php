<?php

namespace App\Http\Controllers\frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\DrivingLesson;
use App\Models\UserService;
use App\Models\SystemBooking;
use App\Models\LatestPayment;
use \App\Models\Booking;
use \App\Models\Page;
use Validator;

class StudentsController extends Controller
{
	public function __construct()
	{
        $this->moduleViewName = "frontend.students";
       
        view()->share("moduleViewName", $this->moduleViewName);
    }

    public function myProfile()
    {        
        $data = array();
        $student = \Auth::user();

        $data['user'] = $student;
        $data['teacher'] = User::getTeacher($student);
        $data['pageTitle'] = $this->breadcrum('myProfile');

        return view($this->moduleViewName.'.myProfile',$data);
    }

    public function editProfile()
    {
        $data = array();
        $student = \Auth::user();

        $data['user'] = $student;
        $data['teacher'] = User::getTeacher($student);
        $data['pageTitle'] = $this->breadcrum('editProfile'); 
        return view($this->moduleViewName.'.editProfile',$data);
    }

    public function updateProfile(Request $request)
    {
        $status = 1;
        $msg = "Your profile has been changed successfully.";
        
        $validator = Validator::make($request->all(), [
            'email_id' => 'required|email',
            'phone_no' => 'required',
            'other_phone_no' => 'required',
        ]);        
        
        if($validator->fails())
        {
            $messages = $validator->messages();
            
            $status = 0;
            $msg = "";
            
            foreach ($messages->all() as $message) 
            {
                $msg .= $message . "<br />";
            }                        
        }
        else
        {

            $user = User::find(\Auth::user()->id);
            if(!$user){
                return ['status' => 0, 'msg' => 'User not found'];
            }

            $email_id = $request->get("email_id");
            $phone_no = $request->get("phone_no");
            $other_phone_no = $request->get("other_phone_no");
            
            $user->email_id = $email_id;
            $user->phone_no = $phone_no;
            $user->other_phone_no = $other_phone_no;
            $user->save();
        }

        return ['status' => $status, 'msg' => $msg];
    }

    public function drivingLessons()
    {
        $data = array();
        $authUser = \Auth::user();

        $data['authUser'] = $authUser;
        $data['pageTitle'] = $this->breadcrum('Køretimer');
        $data['nextBooking'] = SystemBooking::getUserNextBooking($authUser->id);
        $data['bookings'] = SystemBooking::getUserTotalBooking($authUser->id);
        
        return view($this->moduleViewName.'.drivingLessons',$data);
    }

    public function drivingLessonsData(Request $request)
    {
        $authUser = \Auth::user();

        $model = SystemBooking::select(TBL_SYSTEM_BOOKINGS.'.*',TBL_USERS.'.firstname',TBL_USERS.'.lastname')
        ->join(TBL_USERS,TBL_SYSTEM_BOOKINGS.'.user_id',TBL_USERS.'.id')
        ->where(TBL_SYSTEM_BOOKINGS.'.student_id',$authUser->id);

        return \DataTables::eloquent($model)

        ->editColumn('status', function($row) {
            $crrSts = $row->status;
                if($crrSts == 'delete') 
                    return __(ucfirst('Slettet'));
                if($crrSts == 'pending') 
                    return __(ucfirst('verserende'));
                if($crrSts == 'unapproved') 
                    return __(ucfirst('Udeblevet'));
                if($crrSts == 'passed') 
                    return __(ucfirst('bestaet'));
                if($crrSts == 'approved') 
                    return __(ucfirst('godkendt'));
                if($crrSts == 'dumped') 
                    return __(ucfirst('Dumpet'));
                else
                    return '';
        })
        ->editColumn('teacherName', function($row) {
            return ucfirst($row->firstname).' '.ucfirst($row->lastname);
        })
        ->editColumn('start_time', function($row) {
            if(!empty($row->start_time))
                return date('d.m.Y h:i',strtotime($row->start_time));
            else
                return '';
        })
        ->editColumn('lesson_type', function($row) {
            if($row->lesson_type == 2)
                return 'Dobbelttime (2 timer)';
            else if($row->lesson_type == 1)
                return 'Enkelttime (1 time)';
            else
                return ''; 
        })
        ->make(true);
    }

    public function courseTimes()
    {
        $data = array();
        $authUser = \Auth::user();

        $data['authUser'] = $authUser;
        $data['pageTitle'] = $this->breadcrum('Banetider');
        $data['bookings'] = Booking::studentTotalBooking($authUser->Id);
        $data['nextBooking'] = Booking::studentNextBooking($authUser->Id);
        
        return view($this->moduleViewName.'.courseTimes',$data);
    }

    public function courseTimesData(Request $request)
    {
        $authUser = \Auth::user();

        $model = Booking::select(TBL_BOOKINGS.'.*',TBL_BOOKING_TRACKS.'.track_id',TBL_BOOKING_TRACKS.'.time_slot',TBL_BOOKING_TRACKS.'.student_id',TBL_BOOKING_TRACKS.'.id as bookingTrackID',TBL_BOOKING_TRACKS.'.status',TBL_USERS.'.firstname',TBL_USERS.'.lastname')
                ->join(TBL_BOOKING_TRACKS,TBL_BOOKING_TRACKS.'.booking_id',TBL_BOOKINGS.'.id')
                ->leftJoin(TBL_USERS,TBL_USERS.'.id',TBL_BOOKINGS.'.user_id')
                ->where(TBL_BOOKING_TRACKS.'.student_id',$authUser->id);

        return \DataTables::eloquent($model)
        ->editColumn('date', function($row) {
            return date('d.m.Y',strtotime($row->date));
        })
        ->editColumn('user_id', function($row) {
            return ucfirst($row->firstname).' '.ucfirst($row->lastname);
        })
        ->make(true);
    }

    public function documents()
    {
    	$data = array();
    	$authUser = \Auth::user();

        $data['authUser'] = $authUser;
        $data['pageTitle'] = $this->breadcrum('Dokumenter');

        return view($this->moduleViewName.'.documents',$data);
    }

    public function documentsData(Request $request)
    {
		$authUser = \Auth::user();
    	$student_number = $authUser->student_number;
		$category_code  = substr(trim($student_number), 10, -3);

        $model = Page::where('category_code',$category_code);

        return \DataTables::eloquent($model)
       
        ->editColumn('action', function($row) {
        	$html = '';
        	if(!empty($row->file))
        	{
        		$url = asset('uploads/documents/'.$row->file);
        		$html = '<a type="application/octet-stream" href="'.$url.'" download/ class="btn btn-xs btn-success">Download </a>';
        	}
        	return $html;
        })->rawcolumns(['action'])
        ->make(true);
    }

    private function breadcrum($case)
    {
        $pageTitle = array();
        $authUser = \Auth::user();
        
        switch ($case){
            case 'myProfile':
                
                $pageTitle[0] = array(
                    'name'  => __('Din Profil'),
                    'url'   => '#',
                );
                break;

            case 'editProfile':
                
                $pageTitle[0] = array(
                    'name' =>ucfirst($authUser->firstname).' '.ucfirst($authUser->lastname),
                    'url'   => route('myProfile'),
                );

                $pageTitle[1] = array(
                    'name' => __('Rediger'),
                    'url'   => '#',
                );
                break;
            case 'Køretimer':
                
                $pageTitle[0] = array(
                    'name'  => __('Køretimer'),
                    'url'   => '#',
                );
                break;
            case 'Banetider':
                
                $pageTitle[0] = array(
                    'name'  => __('Banetider'),
                    'url'   => '#',
                );
                break;
            case 'Dokumenter':
                
                $pageTitle[0] = array(
                    'name'  => __('Dokumenter'),
                    'url'   => '#',
                );
                break;
        }

        return $pageTitle;
    }
}
