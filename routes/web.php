<?php

use Illuminate\Support\Facades\Route;

// Controllers
use App\Http\Controllers\EventsController;
use App\Http\Controllers\AppointmentsController;
use App\Http\Controllers\ReportsController;

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

Route::get('login', function () {
    return redirect('admin/login');
})->name('login');

Route::get('/', function () {
    return redirect('admin');
});

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();

    // Eventos
    Route::resource('events', EventsController::class);

    // Agenda
    Route::resource('appointments', AppointmentsController::class);
    Route::get('appointments/ajax/list', [AppointmentsController::class, 'list']);

    // Reportes
    Route::get('index/details/{start}', [AppointmentsController::class, 'index_details']);
    Route::get('reports/appointments', [ReportsController::class, 'appointments_index'])->name('reports.appointments.index');
    Route::post('reports/appointments/generate', [ReportsController::class, 'appointments_generate'])->name('reports.appointments.generate');
});

// Clear cache
Route::get('/admin/clear-cache', function() {
    Artisan::call('optimize:clear');
    return redirect('/admin/profile')->with(['message' => 'Cache eliminada.', 'alert-type' => 'success']);
})->name('clear.cache');
