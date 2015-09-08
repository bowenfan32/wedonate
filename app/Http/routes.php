<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


// Users
Route::get('/connect', [
  'as' => 'login', 'uses' => 'AuthController@getLogin'
]);
Route::post('/connect', [
  'as' => 'login', 'uses' => 'AuthController@postLogin'
]);
Route::get('/signup', [
  'as' => 'register', 'uses' => 'AuthController@getRegister'
]);
Route::post('/signup', [
  'as' => 'register', 'uses' => 'AuthController@postRegister'
]);
Route::get('/dashboard', [
  'as' => 'getDashboard', 'uses' => 'DashController@getDashboard'
]);
Route::get('/donate/stripe', [
  'as' => 'donate_stripe', 'uses' => 'DonateController@getStripe'
]);
Route::post('/donate/a/stripe', [
  'as' => 'donate_ajax_stripe', 'uses' => 'DonateController@ajaxPostStripe'
]);

// Stripe Donate
Route::post('/donate/p/stripe', [
  'as' => 'donate_stripe', 'uses' => 'DonateController@postStripe'
]);
Route::get('/donate/success/{uuid}', [
  'as' => 'getDonationSuccess', 'uses' => 'DonateController@getDonationSuccess'
]);
Route::get('/donate/failure/{uuid}', [
  'as' => 'getDonationFailure', 'uses' => 'DonateController@getDonationFailure'
]);
//VK. Added route for donation amount failure
Route::get('/donate/amountfailure/{uuid}', [
  'as' => 'getDonationAmountFailure', 'uses' => 'DonateController@getDonationAmountFailure'
]);

// Base
Route::get('/', [
  'as' => 'getHome', 'uses' => 'HomeController@getHome'
]);

// Connet
Route::get('/connect/p/login', [
  'as' => 'getLogin', 'uses' => 'AuthController@getLogin'
]);
Route::post('/connect/a/login', [
  'as' => 'postLoginAjax', 'uses' => 'AuthController@postLoginAjax'
]);
Route::post('/connect/a/register', [
  'as' => 'postRegisterAjax', 'uses' => 'AuthController@postRegisterAjax'
]);
Route::get('/connect/logout', [
  'as' => 'getLogout', 'uses' => 'AuthController@getLogout'
]);
Route::get('/connect/forgot-password', [
  'as' => 'getForgotPassword', 'uses' => 'AuthController@getForgotPassword'
]);

// Dashboard
Route::get('/dashboard', [
  'as' => 'getDash', 'uses' => 'DashController@getDash'
]);

// Admin - weDonate
Route::get('/dashboard/pages', [
  'as' => 'getPages', 'middleware' => 'auth.wedonate', 'uses' => 'PageController@getPages'
]);
Route::get('/dashboard/causes', [
  'as' => 'getCauses', 'middleware' => 'auth.wedonate', 'uses' => 'AdminWedonateController@getCauses'
]);
Route::get('/dashboard/causes/create', [
  'as' => 'getCausesCreate', 'middleware' => 'auth.wedonate', 'uses' => 'AdminWedonateController@getCausesCreate'
]);
Route::post('/dashboard/causes/create', [
  'as' => 'getCausesCreate', 'middleware' => 'auth.wedonate', 'uses' => 'AdminWedonateController@postCausesCreate'
]);
Route::get('/dashboard/causes/{uuid}', [
  'as' => 'getCause', 'middleware' => 'auth.wedonate', 'uses' => 'AdminWedonateController@getCause'
]);
Route::post('/dashboard/causes/{uuid}', [
  'as' => 'getCause', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@postCause'
]);
Route::get('/dashboard/users', [
  'as' => 'getUsers', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getUsers'
]);
Route::get('/dashboard/users/create', [
  'as' => 'getUserCreate', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getUserCreate'
]);
Route::post('/dashboard/users/create', [
  'as' => 'getUserCreate', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@postUserCreate'
]);
Route::get('/dashboard/users/{uuid}', [
  'as' => 'getUser', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getUser'
]);
Route::get('/dashboard/roles', [
  'as' => 'getRoles', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getRoles'
]);
Route::get('/dashboard/permissions', [
  'as' => 'getPermissions', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getPermissions'
]);
Route::get('/dashboard/funds', [
  'as' => 'getFunds', 'middleware' => 'auth.wedonate',   'uses' => 'AdminWedonateController@getFunds'
]);

// Donator Dash
Route::get('/dashboard/donations', [
  'as' => 'getDonations', 'middleware' => 'auth',   'uses' => 'DashDonationsController@getDonations'
]);

// Pages
Route::get('/sponsors', [
  'as' => 'getSponsors', 'uses' => 'PageController@getSponsors'
]);
Route::get('/volunteer', [
  'as' => 'getVolunteer', 'uses' => 'PageController@getVolunteer'
]);
Route::get('/donate', [
  'as' => 'getDonate', 'uses' => 'PageController@getDonate'
]);
Route::get('/about', [
  'as' => 'getAbout', 'uses' => 'PageController@getAbout'
]);
Route::get('/faq', [
  'as' => 'getFaq', 'uses' => 'PageController@getFaq'
]);
Route::get('/legal/privacy', [
  'as' => 'getPrivacy', 'uses' => 'PageController@getPrivacy'
]);
Route::get('/legal/terms-and-conditions', [
  'as' => 'getTerms', 'uses' => 'PageController@getTerms'
]);
