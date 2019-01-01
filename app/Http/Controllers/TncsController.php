<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Tnc;
use Validator;

class TncsController extends Controller
{
    public function userTerms()
    {
        $data = array();
        $authUser = \Auth::user();
        $data['pageTitle'] = $this->breadcrum('userTerms');
        
        $notifications  = Tnc::notificationCount($authUser->id);

        if(($notifications['count'] > 0) && ($authUser->role == INTERNAL_TEACHER || $authUser->role == EXTERNAL_TEACHER))
        {
        	$data['notifications'] = $notifications;
            return view('frontend.tncs.userTerms',$data);
        }else{
            //$this->Session->setFlash(__('Sorry You have no access.'),'alert/error');
            return redirect('/');
        }
    }

    public function userTermsUpdate(Request $request)
    {
        $radioData = $request->get('data');
            //dd($radioData);
        $status = 1;
        $msg = 'You have Agreed Our Terms & Conditions';

        $rules = [
            'data.*.required' => 'Godkend venligst meddelsen for at komme videre.',
            'data.*.rule' => 'Godkend venligst meddelsen for at komme videre.'
        ];

        $validator = Validator::make($request->all(), [
            'data.*' => 'required', 
        ],$rules);
        // check validations
        if ($validator->fails()) 
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
            $radioData = $request->get('data');
            
            $authUser = \Auth::user();
            if(!empty($radioData) && is_array($radioData))
            {
                foreach ($radioData as $key => $val)
                {
                    if($val == 'yes')
                    {
                        $tnc = \App\Models\TncUser::where('tnc_id',$key)->where('user_id',$authUser->id)->first();

                        if($tnc)
                        {
                            $tnc->agree = 1;
                            $tnc->save();
                        }
                    }else{
                        return ['status' => 0, 'msg' => 'Godkend venligst meddelsen for at komme videre'];
                    }
                }
            }
            else{
                return ['status' => 0, 'msg' => 'Godkend venligst meddelsen for at komme videre'];
            }
        }
        return ['status' => $status, 'msg' => $msg];
    }
    private function breadcrum($case)
    {
        $pageTitle = array();
        $authUser = \Auth::user();
        
        switch ($case){
            case 'userTerms':
                
                $pageTitle[0] = array(
                    'name'  => __('userTerms'),
                    'url'   => '#',
                );
                break;
        }
        
        return $pageTitle;
    }
}
