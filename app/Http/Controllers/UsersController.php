<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DrivingLesson;
use App\Models\UserService;
use App\Models\SystemBooking;
use App\Models\LatestPayment;
use Validator;

class UsersController extends Controller
{
   
    public function dashboard()
    {
        $data = array();
        $data['message'] = $this->get_notification_message();
        $authUser = \Auth::user();

        if($authUser->role == STUDENT)
            return view('frontend.dashboard',$data);
        return view('admin.dashboard',$data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get_notification_message()
    {
        $authUser = \Auth::user();
        $message = '';
        if($authUser->role == 'student'){
            $student_balance = $authUser->balance;

            $userId = $authUser->id;                                
            $student_balance = $this->getUserAvailableBalance($userId);            
            $balance = abs($student_balance);
            
            if ($student_balance <= 0) {
                //Din nuværende saldo er
               $message =  "Din nuværende saldo er: disponibel med ".$balance." kr.";
            }else{

                    $students = User::select(
                                            TBL_USERS.'.id',
                                            TBL_USERS.'.firstname',
                                            TBL_USERS.'.balance',
                                            TBL_USERS.'.phone_no',
                                            TBL_DRIVING_LESSONS.'.student_id',
                                            \DB::raw("count(".TBL_DRIVING_LESSONS.".student_id) as no_of_driving_lessons")
                                        )
                            ->leftJoin(TBL_DRIVING_LESSONS, TBL_DRIVING_LESSONS.'.student_id',TBL_USERS.'.id')
                            //->where( \DB::raw("SELECT CONVERT( CAST(".TBL_USERS.".balance AS DECIMAL(10,2))) AS arrival_time" )
                            //->whereRaw('CAST('.TBL_USERS.'.balance as DECIMAL(10,2))','<', 1000)
                            //->whereRaw('CAST('.TBL_USERS.'.balance as DECIMAL(10,2))','>', 0)
                            ->where(TBL_USERS.'.id', $authUser->id)
                            ->get();

                 
                /*$students = $this->User->find('all',
                    array(
                            'conditions'    => array(
                                'CAST(User.balance AS DECIMAL(10,2)) < 1000',
                                'CAST(User.balance AS DECIMAL(10,2)) >' => 0,
                                'User.id =' => $this->currentUser['User']['id']
                            ),
                            'fields'        => array('User.id','User.firstname','User.balance','User.phone_no','DrivingLessons.student_id','count(DrivingLessons.student_id) as no_of_driving_lessons'),
                            'joins'     => $joins,
                        ));*/

                $message = "Din nuværende saldo er: skyldig med ".$balance." kr.";

                if(count($students) > 0)
                {
                    if($students[0][0]['no_of_driving_lessons'] < 17 && $student_balance < 1000)
                    {
                        // $message = 'Your total balance is '.$student_balance.' amount. If you shall be abel to book more lessons, you will have to deposit more funds';
                        $message = 'Din nuværende saldo: Skyldig med '.$balance.' kr';
                    } 
                }
            }
    
        }else{
            $message = '';
        }
        return utf8_encode($message);
    }

    public function getUserAvailableBalance($userId)
    {
        $user = User::find($userId);
        $returnBalance = 0;

        if(!empty($user))
        {
            $Total_crm_in = 0;
            $gtotal = 0;
            $Balance = 0;
            $UserServices_total = 0;

            $UserServices = UserService::where('user_id',$userId)
                            ->groupBy('id')
                            ->orderBy('posting_date','ASC')
                            ->get();
             
            $currentDate    = date('Y-m-d H:i:s',time());

            $Systembooking = SystemBooking::where('student_id',$userId)
                                            ->where('status', '!=' ,"delete")
                                            ->where('status', '!=' ,"approved")
                                            ->where('status', '!=' ,"unapproved")
                                            ->orderBy('start_time', "ASC")
                                            ->get();

            $student_number = $user->student_number;  

            $Payments = array();
            if(!empty($student_number))
            {
                $Payments = LatestPayment::where('DebitorNummer',$student_number)->get();
                foreach ($Payments as $key => $Payment) 
                { 
                    //$Payment = (object)$Payment['LatestPayments'];
                    $Total_crm_in = $Total_crm_in + round($Payment->Kredit);
                }                
            }
            foreach($UserServices as $UserService)
            {
                $total_price = number_format($UserService->total_price, 2, '.', '');
                $UserServices_total +=  $total_price;
            }
            foreach($Systembooking as $booking)
            {
                $type = ($booking->lesson_type  != '') ? $booking->lesson_type : '1' ;
                $total =  $type*500;
                $gtotal = $gtotal + $total;
            }            

            if($Total_crm_in < 0){
                $Balance =  $Total_crm_in - $UserServices_total;
            }
            else
            {
                $Balance =  (-$Total_crm_in) + $UserServices_total;
            }

            $returnBalance = $Balance + $gtotal;
        }

        return $returnBalance;
    }

    public function myProfile()
    {        
        $data = array();
        $student = \Auth::user();
        $data['user'] = $student;
        $data['teacher'] = User::getTeacher($student);
        $data['pageTitle'] = $this->breadcrum('myProfile');

        return view('frontend.myProfile',$data);
    }

    public function editProfile()
    {
        $data = array();
        $student = \Auth::user();
        $data['user'] = $student;
        $data['teacher'] = User::getTeacher($student);
        $data['pageTitle'] = $this->breadcrum('editProfile'); 
        return view('frontend.editProfile',$data);
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
        }
        
        return $pageTitle;
    }
}
