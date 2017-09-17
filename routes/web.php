<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('signup', [
	'uses' => 'Auth\RegisterController@showRegistrationForm',
	'as'   => 'getSignup',
]);

Route::post('signup', [
	'uses' => 'Auth\RegisterController@register',
	'as'   => 'postSignup',
]);

Route::get('register/verify/{confirmationCode}', [
    'as' => 'confirmation_path',
    'uses' => 'Auth\RegisterController@confirm'
]);

Route::get('login', [
	'uses' => 'Auth\LoginController@showLoginForm',
	'as' => 'getLogin',
]);

Route::post('login', [
	'uses' => 'Auth\LoginController@login',
	'as'   => 'postLogin',
]);

Route::get('logout', [
	'uses' => 'Auth\LoginController@logout',
	'as'   => 'getLogout',
]);

Route::get('dashboard', [
	'uses' => 'DashboardController@index',
	'as'   => 'dashboard-index',
]);

Route::get('ripedata/{ip}', [
	'uses' => 'VisitorController@getRipeData',
	'as'   => 'visitor-ripe-data',
]);

Route::get('visitors', [
	'uses' => 'VisitorController@getNewVisitors',
	'as'   => 'visitors',
]);

Route::get('website/{websiteId}/visitors', [
	'uses' => 'VisitorController@fetchByWebsite',
	'as'   => 'fetch-by-website',
]);

Route::get('visitor/{visitorId}/category/{categoryId}/classify', [
	'uses' => 'VisitorController@classify',
	'as'   => 'classify',
]);

Route::get('actions', [
	'uses' => 'VisitorController@getActions',
	'as'   => 'get-actions',
]);

Route::get('visitors/lead', [
	'uses' => 'VisitorController@getLeadVisitor',
	'as'   => 'lead',
]);

Route::get('visitors/customer', [
	'uses' => 'VisitorController@getCustomerVisitor',
	'as'   => 'customer',
]);

Route::get('visitors/competitor', [
	'uses' => 'VisitorController@getCompetitorVisitor',
	'as'   => 'competitor',
]);

Route::get('visitor/{id}/details', [
	'uses' => 'VisitorController@getVisitorDetails',
	'as' => 'visitor-details',
]);

Route::post('note', [
	'uses' => 'NoteActivtyController@postNote',
	'as' => 'post-note',
]);

Route::post('visitor/{id}/details', [
	'uses' => 'VisitorController@updateVisitorDetails',
	'as' => 'update-contact',
]);

Route::get('website', [
	'uses' => 'WebsiteController@websiteForm',
	'as'   => 'website-form',
]);

Route::post('website', [
	'uses' => 'WebsiteController@registerWebsite',
	'as'   => 'register-website',
]);

Route::get('profile', [
	'uses' => 'UserController@profile',
	'as'   => 'profile',
]);
