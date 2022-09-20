<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EmployeeController;

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
    return view('welcome');
});

Route::group(['prefix' => 'employees'], function () {
    Route::view('/', 'employees')->name('view');
    Route::get('/data', [EmployeeController::class, 'index']);
    Route::post('', [EmployeeController::class, 'addOrUpdate']);
    Route::delete('{id}', [EmployeeController::class, 'delete']);
});
