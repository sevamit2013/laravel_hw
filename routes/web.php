<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetSubCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\LocationController; // Import LocationController
use App\Http\Controllers\PriorityController; // Import PriorityController
use App\Http\Controllers\RoleController; // Import RoleController
use App\Http\Controllers\TicketStatusController; // Import TicketStatusController
use App\Http\Controllers\TicketTypeController; // Import TicketTypeController
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('priorities', PriorityController::class); // Add resource route for priorities
    Route::resource('roles', RoleController::class); // Add resource route for roles
    Route::resource('ticket-statuses', TicketStatusController::class); // Add resource route for ticket statuses
    Route::resource('ticket-types', TicketTypeController::class); // Add resource route for ticket types
    Route::resource('assemblies', AssemblyController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('asset-categories', AssetCategoryController::class);
    Route::resource('asset-sub-categories', AssetSubCategoryController::class);
    Route::resource('tickets', TicketController::class);
    Route::resource('locations', LocationController::class);
});

require __DIR__.'/auth.php';
