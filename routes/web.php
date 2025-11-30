<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssemblyController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AssetCategoryController;
use App\Http\Controllers\AssetSubCategoryController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketReplyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TicketStatusController;
use App\Http\Controllers\TicketTypeController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Master data routes (accessible to all authenticated users)
    Route::resource('priorities', PriorityController::class);
    Route::resource('ticket-statuses', TicketStatusController::class);
    Route::resource('ticket-types', TicketTypeController::class);
    Route::resource('locations', LocationController::class);
    Route::resource('assemblies', AssemblyController::class);
    Route::resource('assets', AssetController::class);
    Route::resource('asset-categories', AssetCategoryController::class);
    Route::resource('asset-sub-categories', AssetSubCategoryController::class);

    // Ticket routes
    Route::resource('tickets', TicketController::class);
    Route::post('tickets/{ticket}/reopen', [TicketController::class, 'reopen'])->name('tickets.reopen');
    
    // Ticket replies
    Route::post('ticket-replies', [TicketReplyController::class, 'store'])->name('ticket-replies.store');

    // Reports (accessible to hw-admin, hw-subadmin, superadmin)
    Route::middleware('role:hw-admin,hw-subadmin,superadmin')->prefix('reports')->group(function () {
        Route::get('/', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/monthly', [ReportController::class, 'monthly'])->name('reports.monthly');
        Route::get('/pending', [ReportController::class, 'pending'])->name('reports.pending');
        Route::get('/completed', [ReportController::class, 'completed'])->name('reports.completed');
        Route::get('/seeker-wise', [ReportController::class, 'seekerWise'])->name('reports.seeker-wise');
        Route::get('/department-wise', [ReportController::class, 'departmentWise'])->name('reports.department-wise');
        Route::get('/assignee-wise', [ReportController::class, 'assigneeWise'])->name('reports.assignee-wise');
        Route::get('/export', [ReportController::class, 'export'])->name('reports.export');
    });

    // Role management (only for superadmin)
    Route::middleware('role:superadmin')->group(function () {
        Route::resource('roles', RoleController::class);
    });
});

require __DIR__.'/auth.php';