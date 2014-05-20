<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// START default routes for search results
Route::get('/', 'DefaultController@homeAction');
Route::any('/search', 'DefaultController@searchAction');
Route::any('/topSearch', 'DefaultController@topSearchAction');
// END default routes for search results

//destinations
Route::post('destination/search', 'DestinationsController@searchAction');
Route::post('destination/new', 'DestinationsController@saveAction');
Route::get('destination/{id}', 'DestinationsController@getAction');
Route::post('destination/{id}', 'DestinationsController@saveAction');

// users
Route::any('users', array('as'=>'users', 'uses' => 'UserController@listAction'));
Route::get('user/{id}', 'UserController@getAction');
Route::post('user/{id}', 'UserController@saveAction');

Route::get('register',      'UserController@getAction');
Route::post('register',      'UserController@saveAction');

Route::any('user/delete/{id}',      'UserController@deleteAction');

Route::any('logout', 'UserController@logoutAction');
Route::any('login', 'UserController@loginAction');

//listings
Route::any('listings', 'ListingsController@listAction');
Route::get('listing/new', 'ListingsController@newAction');
Route::post('listing/new', 'ListingsController@saveAction');

Route::get('listing/{id}', 'ListingsController@getAction');


//reviews
Route::any('reviews', 'ReviewsController@listAction');

Route::get('review/{id}', 'ReviewsController@getAction');
Route::get('review',      'ReviewsController@getAction');
Route::get('review/listing/{id}', 'ReviewsController@getAction');

Route::post('review/listing/{id}', 'ReviewsController@saveAction');

Route::any('review/delete/{id}', 'ReviewsController@deleteAction');


//roles' routes

Route::any('roles', 'RolesController@listAction');

Route::get('role/{id}', 'RolesController@getAction');
Route::get('role',      'RolesController@getAction');

Route::post('role/{id}', 'RolesController@saveAction');
Route::post('role',      'RolesController@saveAction');

Route::any('roles/delete/{id}',      'RolesController@deleteAction');


//ratings' routes

Route::get('listing/rate/{id}', 'ListingsController@getRatingsAction');
Route::post('listing/rate/{id}', 'ListingsController@saveRatingsAction');



Route::any('ratings', 'RatingsController@listAction');

Route::get('rating/{id}', 'RatingsController@getAction');
Route::get('rating',      'RatingsController@getAction');

Route::post('rating/{id}', 'RatingsController@saveAction');
Route::post('rating',      'RatingsController@saveAction');

Route::any('ratings/delete/{id}',      'RatingsController@deleteAction');

/***************************************************************************/
/* ADMIN */

// users
Route::any('admin/users', 'Admin_UsersController@listAction');
Route::get('admin/users/{id}', 'Admin_UsersController@getAction');
Route::post('admin/users/{id}', 'Admin_UsersController@saveAction');
Route::any('admin/users/delete/{id}',      'Admin_UsersController@deleteAction');

//destinations

Route::any('admin/destinations', 'Admin_DestinationsController@listAction');

Route::get('admin/destination/{id}', 'Admin_DestinationsController@getAction');
Route::get('admin/destination',      'Admin_DestinationsController@getAction');

Route::post('admin/destination/{id}', 'Admin_DestinationsController@saveAction');
Route::post('admin/destination',      'Admin_DestinationsController@saveAction');

Route::any('admin/destinations/delete/{id}',      'Admin_DestinationsController@deleteAction');


//listings

Route::any('admin/listings', 'Admin_ListingsController@listAction');

Route::get('admin/listing/{id}', 'Admin_ListingsController@getAction');
Route::get('admin/listing',      'Admin_ListingsController@getAction');

Route::post('admin/listing/{id}', 'Admin_ListingsController@saveAction');
Route::post('admin/listing',      'Admin_ListingsController@saveAction');

Route::any('admin/listings/delete/{id}', 'Admin_ListingsController@deleteAction');

//reviews

Route::any('admin/reviews', 'Admin_ReviewsController@listAction');

Route::get('admin/review/{id}', 'Admin_ReviewsController@getAction');
Route::get('admin/review',      'Admin_ReviewsController@getAction');

Route::post('admin/review/{id}', 'Admin_ReviewsController@saveAction');
Route::post('admin/review',      'Admin_ReviewsController@saveAction');

Route::any('admin/reviews/delete/{id}',      'Admin_ReviewsController@deleteAction');

//ratings

Route::any('admin/ratings', 'Admin_RatingsController@listAction');

Route::get('admin/rating/{id}', 'Admin_RatingsController@getAction');
Route::get('admin/rating',      'Admin_RatingsController@getAction');

Route::post('admin/rating/{id}', 'Admin_RatingsController@saveAction');
Route::post('admin/rating',      'Admin_RatingsController@saveAction');

Route::any('admin/ratings/delete/{id}',      'Admin_RatingsController@deleteAction');

