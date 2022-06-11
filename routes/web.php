<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\RoleControllerResourse;


Route::get('/', function () {return view('welcome');});

Route::middleware(['auth'])->group(function () {
    Route::controller(PostController::class)->group(function () {
        Route::get('/dashboard','index')->name('dashboard')->middleware('can:show-post');
        Route::get('/add-post', 'create')->name('add-post')->middleware('can:add-post');
        Route::post('/store-post', 'store')->name('store-post')->middleware('can:add-post');
        Route::get('/edit-post/{id}', 'edit')->name('edit-post')->middleware('can:edit-post');
        Route::post('/update-post/{id}', 'update')->name('update-post')->middleware('can:edit-post');
        Route::delete('/delete-post/{id}',  'delete')->name('delete-post')->middleware('can:delete-post');
    });

    Route::resource('/roles', RoleControllerResourse::class);
});






require __DIR__.'/auth.php';
