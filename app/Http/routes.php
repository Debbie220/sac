<?php
Route::group(['middleware' => 'web'], function () {
    Route::post('/login', 'StaticPagesController@login')->name('login');
    Route::get('/logout', 'StaticPagesController@logout')->name('logout');

    Route::get('/', 'StaticPagesController@home')->name('home');

    Route::resource('presentation', 'PresentationsController',
        ['except' => 'show']);
    Route::group(['prefix' => 'presentation'], function (){
        Route::patch('{id}/submit', 'PresentationsController@submit')->
            name('presentation.submit');
        Route::patch('{id}/approve', 'PresentationsController@approve')->
            name('presentation.approve');
        Route::get('{id}/decline', 'PresentationsController@decline')->
            name('presentation.decline');
        Route::post('{id}/decline', 'PresentationsController@save_comment')->
            name('presentation.comment');
        Route::get('schedule/{display_room?}', 'PresentationsController@show_schedule')->
            name('presentation.schedule');
        Route::post('updateSchedule/{display_room?}', 'PresentationsController@update_schedule')->
            name('presentation.book');
        Route::get('deleteTime/{display_room}/{id}', 'PresentationsController@deleteTime')->
            name('delete_time');
        Route::post('addTime/{display_room}', 'PresentationsController@addTime')->
            name('add_time');
        Route::get('/{status}', 'PresentationsController@index')->name('presentation.status');
    });

    Route::group(['prefix' => 'conference'], function (){
        Route::get('/old', 'ConferencesController@old')->
            name('conference.old');
        Route::get('/new', 'ConferencesController@create')->
            name('conference.create');
        Route::post('/new', 'ConferencesController@store')->
            name('conference.store');
    });

    Route::get('user/my', 'UsersController@show')->name('user.show');
    Route::group(['prefix' => 'professor/my'], function () {
        Route::get('courses', 'UsersController@my_courses')->
            name('my_courses');
        Route::post('add', 'UsersController@add_course')->
            name('add_course');
        Route::post('remove/{id}', 'UsersController@remove_course')->
            name('remove_course');
    });

    Route::resource('room', 'RoomsController');
    Route::put('changeAvailability/{id}', 'RoomsController@changeAvailability')->
            name('changeAvailability');

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

    Route::group(['prefix' => 'course'], function (){
        Route::get('index', 'CoursesController@index')->name('course.index');
        Route::post('add', 'CoursesController@new_courses')->name('course.add');
    });
});
