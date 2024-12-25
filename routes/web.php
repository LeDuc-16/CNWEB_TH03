<?php

use App\Models\Task;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\Auth\AuthController;

// Hiển thị danh sách các task (Trang Dashboard)
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Hiển thị chi tiết một task
Route::get('task/{task}', [TaskController::class, 'show'])->name('tasks.show');

// Thêm mới task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Xóa task
Route::delete('task/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Đảm bảo người dùng phải đăng nhập trước khi thực hiện các hành động dưới đây
Route::middleware('auth')->group(function() {
    // Các route yêu cầu đăng nhập
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::delete('task/{task}', [TaskController::class, 'destroy']);
});

// Đăng ký route cho đăng ký người dùng
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Đăng ký route cho đăng nhập người dùng
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Đăng xuất người dùng
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

