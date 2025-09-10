<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Panel\DashboardController;
use App\Http\Controllers\Panel\VehicleController;


Route::get('/', function () {
    return view('welcome');
});


// Rutas de autenticación manual para login y logout
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//DASHBOARD GENERAL
Route::get('/dashboard', [DashboardController::class, 'show'])->middleware('auth')->name('dashboard');
Route::get('/usuarios/activos', [DashboardController::class, 'usuariosActivos'])->name('usuarios.activos');

// Usuario
Route::post('/users', [DashboardController::class, 'storeUser'])->name('users.store');
Route::get('/users/list', [DashboardController::class, 'listUsers'])->name('users.list');
Route::get('/users/edit/{id}', [DashboardController::class, 'editUser'])->name('user.edit');
Route::get('/users/delete/{id}', [DashboardController::class, 'deleteUser'])->name('user.delete');

// Vehículos
Route::post('/vehicles', [VehicleController::class, 'storeVehicle'])->name('vehicles.store');
Route::get('/vehicles/list', [VehicleController::class, 'listVehicles'])->name('vehicles.list');
Route::get('/vehicles/edit/{id}', [VehicleController::class, 'editVehicle'])->name('vehicle.edit');
Route::get('/vehicles/delete/{id}', [VehicleController::class, 'deleteVehicle'])->name('vehicle.delete');




