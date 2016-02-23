<?php
Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'StaticPagesController@home')->name('home');
	Route::get('adminhome', 'AdminController@home')->name('adminhome');
	Route::get('admin', 'AdminController@base');



    Route::auth();
	Route::patch('presentation/{id}/submit', 'PresentationsController@submit')
		->name('submit_presentation');
	Route::resource('presentation', 'PresentationsController',
		['except' => 'show']);
	Route::get('/new_role', 'UsersController@request_new_role')
	      ->name('new_role');

		Route::resource('user', 'UsersController', ['only' => 'show']);


});
