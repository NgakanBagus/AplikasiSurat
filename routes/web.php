<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DisposisiSuratController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SuratEksternalController;
use App\Models\DisposisiSurat;
use App\Models\SuratEksternal;

Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);

Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'useradmin'], function() {

    Route::get('panel/dashboard', [DashboardController::class, 'dashboard']);
    
    Route::get('panel/users', [UsersController::class, 'users']);
    Route::get('panel/users/add', [UsersController::class, 'add']);
    Route::post('panel/users/add', [UsersController::class, 'insert']);
    Route::get('panel/users/edit/{id}', [UsersController::class, 'edit']);
    Route::post('panel/users/edit/{id}', [UsersController::class, 'update']);
    Route::get('panel/users/delete/{id}', [UsersController::class, 'delete']);

    Route::get('panel/roles', [RoleController::class, 'list']);
    Route::get('panel/roles/add', [RoleController::class, 'add']);
    Route::post('panel/roles/add', [RoleController::class, 'insert']);
    Route::get('panel/roles/edit/{id}', [RoleController::class, 'edit']);
    Route::post('panel/roles/edit/{id}', [RoleController::class, 'update']);
    Route::get('panel/roles/delete/{id}', [RoleController::class, 'delete']);
   
    Route::get('panel/surat', [SuratController::class, 'surat']);
    
    Route::get('panel/settings', [SettingsController::class, 'settings']);

    Route::get('panel/suratEksternal', [SuratEksternalController::class, 'showAll']);
    Route::get('panel/suratEksternal/add', [SuratEksternalController::class, 'showAddForm']);
    Route::post('panel/suratEksternal/add', [SuratEksternalController::class, 'store']);
    Route::get('panel/suratEksternal/showSurat/{id}', [SuratEksternalController::class, 'showSurat']);
    Route::get('panel/suratEksternal/edit/{id}', [SuratEksternalController::class, 'showEditForm']);
    Route::post('panel/suratEksternal/edit/{id}', [SuratEksternalController::class, 'edit']);
    Route::get('panel/suratEksternal/delete/{id}', [SuratEksternalController::class, 'delete']);

    Route::get('panel/disposisiSurat', [DisposisiSuratController::class, 'showAll'])->name('disposisiSurat.index');
    Route::get('panel/disposisiSurat/add', [DisposisiSuratController::class, 'showAddForm']);
    Route::post('panel/disposisiSurat/add', [DisposisiSuratController::class, 'store']);
    Route::get('panel/disposisiSurat/delete/{id}', [DisposisiSuratController::class, 'delete']);
    Route::get('panel/disposisiSurat/edit/{id}', [DisposisiSuratController::class, 'showEditForm']);
    Route::post('panel/disposisiSurat/edit/{id}', [DisposisiSuratController::class, 'edit']);
    Route::put('panel/disposisiSurat/{id}/update', [DisposisiSuratController::class, 'edit'])->name('disposisiSurat.update');

    Route::post('panel/disposisiSurat/updateStatus/{id}', [DisposisiSuratController::class, 'updateStatus'])->name('disposisiSurat.updateStatus');

});


