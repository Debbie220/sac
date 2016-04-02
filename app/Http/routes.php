<?php
Route::group(['middleware' => 'web'], function () {
    Route::get('/', 'StaticPagesController@home')->name('home');
    Route::auth();

    Route::resource('presentation', 'PresentationsController',
        ['except' => 'show']);
    Route::group(['prefix' => 'presentation'], function (){
        Route::patch('{id}/submit', 'PresentationsController@submit')->
            name('presentation.submit');
        Route::patch('{id}/approve', 'PresentationsController@approve')->
            name('presentation.approve');
        Route::get('pending', 'PresentationsController@pending')->
            name('presentation.pending');
        Route::patch('{id}/decline', 'PresentationsController@decline')->
            name('presentation.decline');
        Route::post('{id}/decline', 'PresentationsController@save_comment')->
            name('presentation.comment');
    });

    Route::resource('user', 'UsersController', ['only' => 'show']);

    Route::resource('room', 'RoomsController');
    Route::group(['prefix' => 'role'], function () {
        Route::get('requests', 'RolesController@index')->
            name('role.index');
        Route::patch('{id}/approve', 'RolesController@approve')->
            name('role.approve');
        Route::patch('{id}/decline', 'RolesController@decline')->
            name('role.decline');
        Route::get('{id}/new', 'RolesController@new_role')->
            name('role.new');
    });

    Route::group(['prefix' => 'admin'], function () {
        Route::put('changeAvailability/{id}', 'RoomsController@changeAvailability')->
            name('changeAvailability');
        Route::get('courses', 'AdminController@view_courses')->name('courses');
    });

    Route::group(['prefix' => 'professor/my'], function () {
        Route::get('courses', 'UsersController@my_courses')->
            name('my_courses');
        Route::post('add', 'UsersController@add_course')->
            name('add_course');
        Route::post('remove/{id}', 'UsersController@remove_course')->
            name('remove_course');
    });
});
