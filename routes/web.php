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
Route::post('/edit', [CustomerController::class, 'edit']);
Route::post('/delete', [CustomerController::class, 'delete']);
Route::post('/userupdate', [CustomerController::class,'userupdate']);
Route::post('/updatenote', [CustomerController::class, 'updatenote']);
Route::get('/image/{id}', [CustomerController::class, 'showImg'])->name('image.show');
Route::get('/survey', [CustomerController::class, 'survey']);



// Datatables Routes
//Route::post('/admin', [DataController::class, 'getRecords'])->name('adminData');
Route::get('/datatables', [DataController::class, 'index'])->name('datatables');
Route::get('/datacustom', [DataController::class,'filter']);
Route::post('/fetchDept', [DataController::class,'fetchDept']);
Route::post('/fetchAdmin', [DataController::class,'fetchAdmin']);
Route::get('/customer', [DataController::class, 'customer'])->name('customer');
Route::get('/admin-users', [DataController::class, 'adminusers'])->name('admin-users');
Route::get('/department', [DataController::class, 'department'])->name('department');
Route::get('/dashboard', [DataController::class, 'records'])->name('dashboard');
Route::get('/chart', [DataController::class, 'chart']);
Route::get('/line', [DataController::class, 'line']);
Route::get('/bar', [DataController::class, 'bar']);
Route::get('/donut', [DataController::class, 'donut']);


// Admin Routes

Route::get('/main', [AdminController::class, 'main'])->name('main');
Route::post('/insert', [AdminController::class,'insert']);
Route::post('/update', [AdminController::class,'update']);
Route::post('/remove', [AdminController::class,'remove']);
Route::post('/insertDept', [AdminController::class,'insertDept']);
Route::post('/editDept', [AdminController::class,'editDept']);
Route::post('/Deptremove', [AdminController::class,'Deptremove']);
Route::post('/statuschange', [AdminController::class, 'statuschange']);
Route::post('/accepttix', [AdminController::class, 'accepttix']);

// Action Buttons


// Notification
Route::get('/markasread', [AdminController::class, 'markasread']);

// Profile Updates
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profileUpdate', [ProfileController::class, 'update' ]);

