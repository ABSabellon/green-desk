<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/gradeconsultation', function () {
    return view('gc');
});

Route::get('/finalexams', function () {
    return view('finals');
});

Route::post('/add_reservation', [
    'uses' => 'GCController@postAddReservation',
    'as' => 'add.reservation'
]);

Route::get('/get_reservations_gc', [
    'uses' => 'GCController@getReservations',
    'as' => 'get.reservations.gc'
]);

Route::post('/edit_reservation_gc', [
    'uses' => 'GCController@postEditReservation',
    'as' => 'edit.reservation.gc'
]);

Route::get('/get_reservations_exam', [
    'uses' => 'ExamController@getReservations',
    'as' => 'get.reservations.exam'
]);

Route::post('/edit_reservation_exam', [
    'uses' => 'ExamController@postEditReservation',
    'as' => 'edit.reservation.exam'
]);

Route::get('/get_rooms', [
    'uses' => 'RoomController@getRooms',
    'as' => 'get.rooms'
]);

Route::get('/get_rooms_by_floor', [
    'uses' => 'RoomController@getRoomsByFloor',
    'as' => 'get.rooms.floor'
]);

Route::get('/search_rooms', [
    'uses' => 'SearchController@getRooms',
    'as' => 'search.rooms'
]);

Route::get('/search_reservations', [
    'uses' => 'SearchController@getReservations',
    'as' => 'search.reservations'
]);

Route::get('/get_professors', [
    'uses' => 'ReserveeController@getProfessors',
    'as' => 'get.professors'
]);

Route::post('/add_professor', [
    'uses' => 'ReserveeController@postAddProfessor',
    'as' => 'add.professor'
]);

Route::post('/set_active_professor', [
    'uses' => 'ReserveeController@postSetActive',
    'as' => 'set.active'
]);

Route::get('/export', ['uses' => 'GCController@export', 'as' => 'export']);
Route::post('/import', ['uses' => 'GCController@import', 'as' => 'import']);
Route::post('/professor/import', ['uses' => 'ReserveeController@import', 'as' => 'professor.import']);