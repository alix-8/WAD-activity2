<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;  
use App\Http\Controllers\PropertyController; 
use App\Http\Controllers\AmenityController;
use App\Http\Controllers\AddressController; 
use App\Http\Controllers\AgentController;    
use Illuminate\Support\Facades\Route;

// WITH AUTH MIDDLEWARE: Uncomment this block when ready to implement authenticationnnn
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     // Profile Routes here : D
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//     // resource routes for properties, amenities, and agents
//     Route::resource('properties', PropertyController::class);
//     Route::resource('amenities', AmenityController::class);
//     Route::resource('agents', AgentController::class);
// });

// require __DIR__.'/auth.php';

Route::get('/', function () {
    return view('welcome');
});


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('properties', PropertyController::class);
Route::resource('addresses', AddressController::class);
Route::resource('amenities', AmenityController::class);
Route::resource('agents', AgentController::class);

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

require __DIR__.'/auth.php';