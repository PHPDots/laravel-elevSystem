<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public $redirectPath = '/dashboard';
    public $redirectAfterLogout = '/';
    //public $loginPath = '/admin'; 
    
    public function __construct()
    {
    	$this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogin()
    {        
        if(\Request::is('admin'))
            return view('admin.before_login.login');
        else
            return view('frontend.before_login.login');
    }

    public function postLogin(Request $request)
    {
        $status = 0;
        $msg = __('Din bruger kan ikke dette');
        
        $validator = Validator::make($request->all(), [
            'username' => 'required', 
            'password' => 'required',
        ]);        
        
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
            if (Auth::attempt(['email_id' => $request->get('username'), 'password' => $request->get('password'),'is_completed'=>' != 2'])) 
            {
                $user = Auth::user();

                $status = 1;
                $msg = "Logget ind med succes.";
                $user->last_login_at = \Carbon\Carbon::now();
                $user->save();

                $notifications   = \App\Models\Tnc::notificationCount($user->id,'count');
                if($user->role == INTERNAL_TEACHER || $user->role == EXTERNAL_TEACHER)
                {
                    if($notifications['count'] > 0)
                    {
                        return ['status' => 2, 'msg' => 'tnc'];
                    }
                }
                if($user->role == STUDENT && $user->is_login_firsttime == 1)
                {
                    \session()->put(['is_login_firsttime' => 1]);
                }
            }
            if (Auth::attempt(['username' => $request->get('username'), 'password' => $request->get('password'),'is_completed'=>'!= 2']))
            {
            	$user = Auth::user();
                
                $status = 1;
                $msg = "Logget ind med succes.";
                $user->last_login_at = \Carbon\Carbon::now();
                $user->save();

                $notifications   = \App\Models\Tnc::notificationCount($user->id,'count');
                if($user->role == INTERNAL_TEACHER || $user->role == EXTERNAL_TEACHER)
                {
                    if($notifications['count'] > 0)
                    {
                        return ['status' => 2, 'msg' => 'tnc'];
                    }
                }
                if($user->role == STUDENT && $user->is_login_firsttime == 1)
                {
                    \session()->put(['is_login_firsttime' => 1]);
                }
            }
        }
        
        if($request->isXmlHttpRequest())
        {
            return ['status' => $status, 'msg' => $msg];
        }
        else
        {
            if($status == 0)
            {
                session()->flash('error_message', $msg);
            }
           // return redirect('login');
        }
    }

    public function getLogout()
    {
        $user = Auth::user();
        Auth::logout();
        
        /*// save log
        $params=array();
        $params['adminuserid']	= $user->id;
        $params['actionid']	= $this->adminAction->ADMIN_LOGOUT;
        $params['actionvalue']	= $user->id;
        $params['remark']	= 'Logout Admin User';

        \App\Models\AdminLog::writeadminlog($params);
        unset($params);*/
        
       // \sesion()->put('is_login_firsttime',0);

        return redirect('/');
    } 
    
    public function forgotPassword()
    {
      $data = array();
      $data['title'] = 'Forgot Password | '.env('APP_SITE_TITLE');
      
      if(\Request::is('admin/*'))
            return view('admin.before_login.forgotPassword',$data);
        else
            return view('frontend.before_login.forgotPassword',$data);

    }
    public function forgotPasswordData(Request $request)
    {
        $status = 1;
        $msg = __('Vi har sendt en e-mail til dig, så du kan genskabe dit password. Tjek venligst din mail.');
        
        $validator = Validator::make($request->all(), [
            'verification_data' => 'required', 
        ]);
        
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
            $userdetail = $request->get('verification_data');
            $user = User::where('username',$userdetail)->first();
            if(!$user)
                $user = User::where('email_id',$userdetail)->first();
            if(!$user){
                $status = 0;
                $msg = __('Brugernavn eller e-mail er ikke korrekt. Indtast et korrekt');
                return ['status' => $status, 'msg' => $msg];
            }else{

                $keyPass = generatePassword(8);
                $user->activation_key = $keyPass; 
                $user->save();

                // send email to user
                $userEmail = $user->email_id;
                if(empty($userEmail))
                    $userEmail = 'elevsystem123@gmail.com';
                $subject = __("Glemt Kodeord");

                $Path = route('resetPassword.user',['username'=>$user->username,'key'=>$keyPass]);
                if(isset($request->type) && $request->type == 1)
                    $Path = route('resetPassword.admin',['username'=>$user->username,'key'=>$keyPass]);
                
                $message = array();
                $message['firstname'] = ucfirst($user->firstname);
                $message['lastname'] = ucfirst($user->lastname);
                $message['username'] = $user->username;
                $message['activationlink'] = $Path;

                $returnHTML = view('emails.forgotPassword',$message)->render();
            
                $params["to"]=$userEmail;
                $params["subject"] = $subject;
                $params["body"] = $returnHTML;
                sendHtmlMail($params);
            }
            return ['status' => $status, 'msg' => $msg];
        }
    }

    public function resetPassword($username,$key)
    {
        $user = User::where('username',$username)->where('activation_key',$key)->first();
        if(!$user)
            return redirect('/');

        \session()->put(['username'=>$username]);
        \session()->put(['key'=>$key]);

        if(\Request::is('admin/*'))
            return view('admin.before_login.resetPassword');
        else
            return view('frontend.before_login.resetPassword');
    }

    public function resetPasswordData(Request $request)
    {
        $status = 1;
        $msg = __("Dit password er gendannet");

        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ]);

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
            $newPassword = $request->get('password');
            
            $user = User::where('username',\session()->get('username'))
                        ->where('activation_key',\session()->get('key'))
                        ->first();

            if($user)
            {
                $user->password = bcrypt($request->get('password'));
                $user->activation_key = '';
                $user->save();
            }
            else
            {
                $status = 0;
                $msg = __('Bruger ikke fundet');
            }
        }
        
        return ['status' => $status, 'msg' => $msg];
    }
}
