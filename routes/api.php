<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Container;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

// Containers
Route::get('containers', function() {
  return Containers::all();
});

Route::get('containers/{id}', function($id) {
  return Container::find($id);
});
