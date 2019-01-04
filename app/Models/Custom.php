<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    public static function isUserFirstTimeLogin()
    {
    	if(\session()->has(['is_login_firsttime']))
    	{
	    	$firstTime = \session()->get('is_login_firsttime');
	    	if(!empty($firstTime) && $firstTime == 1)
	    	{
	    		return true;
	    	}else{
	    		return false;
	    	}
    	}
    }
}
