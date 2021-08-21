<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * ---------------------------------------------------
 * AUTHENTICATION
 * ---------------------------------------------------
 */
Route::post('/register', 'AuthAPIController@register');
Route::post('/login', 'AuthAPIController@login');

Route::middleware(['auth:api'])->group(function () {
    // calendar
    Route::get('/calendar-data', 'CalendarAPIController@index');
    // employee / user
    Route::get('/employees', 'EmployeeAPIController@index');
    // leave type
    Route::get('/leave-types', 'LeaveTypeAPIController@index');
    Route::post('/leave-types', 'LeaveTypeAPIController@store');
    Route::delete('/leave-types/{id}', 'LeaveTypeAPIController@destroy');
    // leave
    Route::get('/leaves', 'LeaveAPIController@index');
    Route::post('/leaves', 'LeaveAPIController@store');
    // holiday
    Route::get('/holidays', 'HolidayAPIController@index');
    Route::post('/holidays', 'HolidayAPIController@store');
    Route::delete('/holidays/{id}', 'HolidayAPIController@destroy');
});
