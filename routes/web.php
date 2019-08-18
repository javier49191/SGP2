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
    return redirect()->route('alumnos.index');
});

Auth::routes();

Route::resource('alumnos', 'AlumnosController');
Route::resource('padrinos', 'PadrinosController');
Route::resource('aportes', 'AportesController');
Route::resource('estados', 'EstadosFinancierosController');
Route::resource('usuarios', 'UsersController');
Route::resource('vinculaciones', 'vinculacionesController');

// Datatable
Route::get('alumnosDatatable', 'AlumnosController@datatable');
Route::get('padrinosDatatable', 'PadrinosController@datatable');
Route::get('aportesDatatable', 'AportesController@datatable');
Route::get('estadosDatatable', 'EstadosFinancierosController@datatable');
Route::get('vinculacionesDatatable', 'VinculacionesController@datatable');
Route::get('novinculadoDatatable', 'VinculacionesController@datatablenv');

// Profile
Route::get('profile', 'UsersController@profile')->name('profile');
Route::post('profile', 'UsersController@update_avatar')->name('profile');