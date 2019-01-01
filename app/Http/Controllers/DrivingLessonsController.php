<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Booking;
use \App\Models\DrivingLesson;
use \App\Models\SystemBooking;
use \Datatables;

class DrivingLessonsController extends Controller
{
    public function __construct() {

        $this->moduleRouteText = "drivingLessons";
        $this->moduleViewName = "frontend.drivingLessons";
        $this->list_url = route($this->moduleRouteText.".index");

        $module = "Driving Lesson";
        $this->module = $module;  

        //$this->adminAction= new \App\Models\AdminAction;        

        $this->modelObj = new DrivingLesson;  
      
        $this->addMsg = $module . " has been added successfully!";
        $this->updateMsg = $module . " has been updated successfully!";
        $this->deleteMsg = $module . " has been deleted successfully!";
        $this->deleteErrorMsg = $module . " can not deleted!";

        view()->share("list_url", $this->list_url);
        view()->share("moduleRouteText", $this->moduleRouteText);
        view()->share("moduleViewName", $this->moduleViewName);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = array();
        $data['pageTitle'] = $this->breadcrum('Køretimer');
        $authUser = \Auth::user();
        $data['authUser'] = $authUser;
        $authUser = \Auth::user();

        $data['nextBooking'] = Booking::getUserNextBooking($authUser->id);
        $data['bookings'] = SystemBooking::where('student_id',$authUser->id)
                            ->count();
        
        return view('frontend.drivingLessons.index',$data);
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

    public function data(Request $request)
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

    private function breadcrum($case)
    {
        $pageTitle = array();
        $authUser = \Auth::user();
        
        switch ($case){
            case 'Køretimer':
                
                $pageTitle[0] = array(
                    'name'  => __('Køretimer'),
                    'url'   => '#',
                );
                break;
        }
        
        return $pageTitle;
    }
}
