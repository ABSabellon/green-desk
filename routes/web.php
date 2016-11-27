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
    return view('newview');
});

Route::post('/add_reservation', [
    'uses' => 'ReservationController@postAddReservation',
    'as' => 'add.reservation'
]);

Route::get('/get_reservations', [
    'uses' => 'ReservationController@getReservations',
    'as' => 'get.reservations'
]);

Route::post('/edit_reservation', [
    'uses' => 'ReservationController@postEditReservation',
    'as' => 'edit.reservation'
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

Route::get('/export', ['uses' => 'ReservationController@export', 'as' => 'export']);
