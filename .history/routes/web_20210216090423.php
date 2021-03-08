<?php

use Illuminate\Support\Facades\Route;

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
    return view('landing-r.welcome');

});
Route::get('/tracking', function () {
    return view('landing-r.TrackPackage');

});
Route::get('/contact-us', function () {
    return view('landing-r.Contact-Us');

});
Route::get('/for-business', function () {
    return view('landing-r.for_business');

});
Route::get('/for-drivers', function () {
    return view('landing-r.for-drivers');

});
Route::get('/about-us', function () {
    return view('landing-r.About_US');

});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
