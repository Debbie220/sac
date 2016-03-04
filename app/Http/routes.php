<?php
Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'StaticPagesController@home')->name('home');
	Route::get('adminhome', 'AdminController@home')->name('adminhome');
	Route::get('admin', 'AdminController@base');

	Route::get('rooms', 'RoomsController@show')->name('show_rooms');
	Route::get('add_rooms', 'RoomsController@create')->name('add_room');
	Route::post('store_room', 'RoomsController@store')->name('store');
	Route::delete('delete_room/{id}', 'RoomsController@destroy')->name('delete_room');
	Route::get('/admin/presentations', 'PresentationsController@view_presentations_admin')
	                                           ->name('presentations');
	Route::get('/admin/approve_presentation', 'PresentationsController@approve_presentation')
	                           ->name('approve_presentation');
	Route::get('/admin/decline_presentation', 'PresentationsController@decline_presentation')
	                          ->name('decline_presentation');
	Route::get('/admin/courses', 'AdminController@view_courses')->name('courses');
  Route::get('/admin/requests', 'AdminController@show_requests')->name('requests');
	Route::get('/admin/approve_request/{id}', 'AdminController@approve_request')->name('approve_request');
	Route::get('/admin/decline_request/{id}', 'AdminController@decline_request')->name('decline_request');

    Route::auth();
	Route::patch('presentation/{id}/submit', 'PresentationsController@submit')
		->name('submit_presentation');
	Route::resource('presentation', 'PresentationsController',
		['except' => 'show']);

	Route::get('/new_role', 'UsersController@request_new_role')
	      ->name('new_role');
	Route::resource('user', 'UsersController', ['only' => 'show']);


});
