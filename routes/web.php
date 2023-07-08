<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegionController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return response(array("message"=>"hello from laravel"));
});
Route::get("/get-region-list", [RegionController::class, 'index']);
