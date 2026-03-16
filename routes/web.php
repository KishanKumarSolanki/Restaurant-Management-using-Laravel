<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuCategoryController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffAssignmentController;
use App\Http\Controllers\StaffMemberController;
use App\Http\Controllers\StaffShiftController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/home', function () {
    return view('home');
})->middleware(['auth'])->name('home');

route::resource('customers', CustomerController::class)->middleware(['auth']); 
route::resource('items', ItemController::class)->middleware(['auth']);
route::resource('menu-categories', MenuCategoryController::class)->except(['show'])->middleware(['auth']);
route::resource('orders', OrderController::class)->middleware(['auth']);
route::resource('staff-members', StaffMemberController::class)->except(['show'])->middleware(['auth']);
route::resource('staff-shifts', StaffShiftController::class)->except(['show'])->middleware(['auth']);
Route::get('/reports', [ReportController::class, 'index'])->middleware(['auth'])->name('reports.index');
Route::get('/staff/create', [StaffAssignmentController::class, 'create'])->middleware(['auth'])->name('staff.create');
Route::post('/staff', [StaffAssignmentController::class, 'store'])->middleware(['auth'])->name('staff.store');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
