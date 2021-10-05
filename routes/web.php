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

Auth::routes();

Route::get('/', [\App\Http\Controllers\PagesController::class, 'home'])->name('home');


// Container
Route::resource('container', \App\Http\Controllers\ContainerController::class);
Route::post('/container/{container}/check/in', [\App\Http\Controllers\ContainerController::class, 'checkIn'])->name('container.check.in');
Route::post('/container/{container}/check/out', [\App\Http\Controllers\ContainerController::class, 'checkOut'])->name('container.check.out');
Route::get('/container/{container}/check', [\App\Http\Controllers\ContainerController::class, 'isCheckedIn'])->name('container.checked');
/* // TODO: add reservation functionality
Route::post('/container/{container}/reserve/{reservation}', [\App\Http\Controllers\ContainerController::class, 'addReservation'])->name('location.add.reservation');
Route::post('/container/{container}/'reserve/{reservation}, [\App\Http\Controllers\ContainerController::class, 'deleteReservation'])->name('location.delete.reservation');
*/
Route::post('/container/{container}/status/{statusId}', [\App\Http\Controllers\ContainerController::class, 'setStatus'])->name('container.set.status');
Route::get('/container/{container}/status', [\App\Http\Controllers\ContainerController::class, 'getStatus'])->name('container.get.status');
Route::post('/container/{container}/container/{connectedContainer}', [\App\Http\Controllers\LocationController::class, 'connectContainer'])->name('container.connect.container');
Route::delete('/container/{container}/container/{connectedContainer}', [\App\Http\Controllers\LocationController::class, 'disconnectContainer'])->name('container.disconnect.container');
Route::get('/container/{container}/container', [\App\Http\Controllers\ContainerController::class, 'getConnectContainerList'])->name('container.get.connected.container');
Route::post('/container/{container}/path/{path}', [\App\Http\Controllers\ContainerController::class, 'addPath'])->name('container.add.path');
Route::delete('/container/{container}/path/{path}', [\App\Http\Controllers\ContainerController::class, 'deletePath'])->name('container.delete.path');
Route::delete('/container/{container}/path', [\App\Http\Controllers\ContainerController::class, 'getPath'])->name('container.get.path');

// Location
Route::resource('location', \App\Http\Controllers\LocationController::class);
Route::post('/location/{location}/location/{parentLocation}', [\App\Http\Controllers\LocationController::class, 'addParentLocation'])->name('location.add.parent.location');
Route::delete('/location/{location}/location/{parentLocation}', [\App\Http\Controllers\LocationController::class, 'deleteParentLocation'])->name('location.delete.parent.location');
Route::get('/location/{location}/location', [\App\Http\Controllers\LocationController::class, 'getParentLocation'])->name('location.get.parent.location');
Route::delete('/location/{location}/location', [\App\Http\Controllers\LocationController::class, 'getParentLocation'])->name('location.get.parent.location');
Route::post('/location/{location}/container/{container}', [\App\Http\Controllers\LocationController::class, 'addContainer'])->name('location.add.container');
Route::delete('/location/{location}/container/{container}', [\App\Http\Controllers\LocationController::class, 'deleteContainer'])->name('location.delete.container');
Route::get('/location/{location}/container', [\App\Http\Controllers\LocationController::class, 'getContainerList'])->name('location.get.container');
Route::post('/location/{location}/path/{path}', [\App\Http\Controllers\LocationController::class, 'addPath'])->name('location.add.path');
Route::delete('/location/{location}/path/{path}', [\App\Http\Controllers\LocationController::class, 'deletePath'])->name('location.delete.path');
Route::get('/location/{location}/path', [\App\Http\Controllers\LocationController::class, 'getPath'])->name('location.get.path');

// Packlist
Route::resource('packlist', \App\Http\Controllers\PacklistController::class);
Route::get('/packlist/create/{packlistTemplate}', [\App\Http\Controllers\PacklistController::class, 'createFromTemplate'])->name('packlist.create.from.template');
Route::post('/packlist/{packlist}/container/{container}', [\App\Http\Controllers\PacklistController::class, 'addContainer'])->name('packlist.add.container');
Route::post('/packlist/{packlist}/container/{container}/update', [\App\Http\Controllers\PacklistController::class, 'updateContainer'])->name('packlist.update.container');
Route::delete('/packlist/{packlist}/container/{container}', [\App\Http\Controllers\PacklistController::class, 'deleteContainer'])->name('packlist.delete.container');
Route::get('/packlist/{packlist}/container', [\App\Http\Controllers\PacklistController::class, 'getContainerList'])->name('packlist.get.container');

// PacklistTemplate
Route::resource('packlist-template', \App\Http\Controllers\PacklistTemplateController::class);
Route::post('/packlist/template/{template}/container/{container}', [\App\Http\Controllers\PacklistTemplateController::class, 'addContainer'])->name('packlist-template.add.container');
Route::post('/packlist/template/{template}/container/{container}/update', [\App\Http\Controllers\PacklistTemplateController::class, 'updateContainer'])->name('packlist-template.update.container');
Route::delete('/packlist/template/{template}/container/{container}', [\App\Http\Controllers\PacklistTemplateController::class, 'deleteContainer'])->name('packlist-template.delete.container');
Route::get('/packlist/template/{template}/container', [\App\Http\Controllers\PacklistTemplateController::class, 'getContainerList'])->name('packlist-template.get.container');

// Path
Route::resource('path', \App\Http\Controllers\PathController::class);
