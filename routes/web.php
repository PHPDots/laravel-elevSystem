<?php

$ADMIN_PREFIX = "admin";
$FRONTED_PREFIX = "users";

//********************     CACHE ROUTE     ********************//
Route::get('clear-cache', function () {
	$exitCode = Artisan::call('cache:clear');
	$exitCode = Artisan::call('view:clear');
	$exitCode = Artisan::call('route:clear');
	$exitCode = Artisan::call('config:clear');
	$exitCode = Artisan::call('debugbar:clear');
	return ["status" => 1, "msg" => "Cache cleared successfully!"];
});

//********************     BEFORE LOGIN ROUTE  ********************//

Route::get('/', 'LoginController@getLogin');
Route::get('admin', 'LoginController@getLogin')->name("admin_login");
Route::post('check-login', 'LoginController@postLogin')->name("check_admin_login");

//********************     FORGOT PASSWORD ROUTE  ********************//

Route::group(['prefix' => $ADMIN_PREFIX], function() {

	Route::get('/forgotPassword', 'LoginController@forgotPassword')->name("forgotPassword.admin");
	Route::get('resetPassword/{username}/{key}', 'LoginController@resetPassword')->name("resetPassword.admin");

});
Route::group(['prefix' => $FRONTED_PREFIX], function() {

	Route::get('/forgotPassword', 'LoginController@forgotPassword')->name("forgotPassword.user");
	Route::get('resetPassword/{username}/{key}', 'LoginController@resetPassword')->name("resetPassword.user");

});
Route::post('forgotPassword/data', 'LoginController@forgotPasswordData')->name("forgotPassword.data");
Route::post('resetPassword/data', 'LoginController@resetPasswordData')->name("resetPassword.data");

//********************     AFTER LOGIN ROUTE  ********************//

Route::group(['middleware' => 'auth'], function(){
	
    Route::get('logout', 'LoginController@getLogout')->name("logout");
    Route::get('/dashboard', 'UsersController@dashboard')->name("dashboard");
    
//My Profile
    Route::get('/myProfile', 'UsersController@myProfile')->name("myProfile");
    Route::get('/myProfile/edit', 'UsersController@editProfile')->name("editProfile");
    Route::post('/myProfile-data', 'UsersController@updateProfile')->name("updateProfile");

//Driving Lessons
    Route::any('/drivingLessons/data', 'DrivingLessonsController@data')->name('drivingLessons.data');
    Route::resource('/drivingLessons', 'DrivingLessonsController');

//Tnc 
    Route::get('/tnc', 'TncsController@userTerms')->name('userTerms');
    Route::post('/tnc-update', 'TncsController@userTermsUpdate')->name('userTermsUpdate');
	
});

