<?php
Route::group(['middleware' => 'web'], function () {
	Route::get('/', 'StaticPagesController@home')->name('home');
    Route::auth();
	Route::patch('presentation/{id}/submit', 'PresentationsController@submit')
		->name('submit_presentation');
	Route::resource('presentation', 'PresentationsController',
		['except' => 'show']);

	Route::get('/new_role', 'UsersController@request_new_role')
	      ->name('new_role');
	Route::resource('user', 'UsersController', ['only' => 'show']);
	Route::group(['prefix' => 'professor/my'], function () {
    	Route::get('courses', 'UsersController@my_courses')->
    		name('my_courses');
		Route::post('add', 'UsersController@add_course')->
			name('add_course');
		Route::post('remove/{id}', 'UsersController@remove_course')->
			name('remove_course');
	});
});
