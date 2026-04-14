<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\PropertyController; 
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AddressController; 
use App\Http\Controllers\AgentController;    
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Public Routes
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

   
    Route::resource('properties', PropertyController::class);
    Route::resource('agents', AgentController::class);
    Route::resource('amenities', AmenityController::class);
    Route::resource('addresses', AddressController::class);
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('users', UserController::class); 
});

require __DIR__.'/auth.php';