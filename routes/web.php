<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NotifController;
use App\Events\SendNotification;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Customer Routes
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/usermain', [CustomerController::class, 'usermain'])->name('main');
Route::post('/store', [CustomerController::class,'store']);
Route::post('/update', [CustomerController::class,'update']);
Route::post('/updatenote', [CustomerController::class, 'updatenote']);
//Route::post('/note', [CustomerController::class, 'note']);

Route::get('/image/{id}', [CustomerController::class, 'showImg'])->name('image.show');

// Datatables Routes
Route::post('/admin', [DataController::class, 'getRecords'])->name('adminData');
Route::get('/datatables', [DataController::class, 'index'])->name('datatables');
Route::get('/datacustom', [DataController::class,'filter']);

// Admin Routes
Route::get('/dashboard', [AdminController::class, 'records'])->name('dashboard');
Route::get('/customer', [AdminController::class, 'customer'])->name('customer');
Route::get('/admin-users', [AdminController::class, 'adminusers'])->name('admin-users');
Route::get('/department', [AdminController::class, 'department'])->name('department');
Route::get('/main', [AdminController::class, 'main'])->name('main');
Route::post('/insert', [AdminController::class,'insert']);
Route::post('/insertDept', [AdminController::class,'insertDept']);
Route::post('/editDept', [AdminController::class,'editDept']);
Route::post('/remove', [AdminController::class,'remove']);
Route::post('/Deptremove', [AdminController::class,'Deptremove']);
Route::post('/fetchDept', [AdminController::class,'fetchDept']);
Route::post('/fetchAdmin', [AdminController::class,'fetchAdmin']);

// Action Buttons
Route::post('/edit', [CustomerController::class, 'edit']);
Route::post('/delete', [CustomerController::class, 'delete']);
Route::post('/statuschange', [AdminController::class, 'statuschange']);
Route::post('/accepttix', [AdminController::class, 'accepttix']);

// Analytics for Dashboard
Route::get('/chart', [AdminController::class, 'chart']);
Route::get('/line', [AdminController::class, 'line']);
Route::get('/bar', [AdminController::class, 'bar']);
Route::get('/donut', [AdminController::class, 'donut']);

// Notification
Route::get('/markasread', [AdminController::class, 'markasread']);

// Profile Updates
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profileUpdate', [ProfileController::class, 'update' ]);

