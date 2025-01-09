<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Auth::routes();

Route::post('follow/{user}', [App\Http\Controllers\FollowsController::class, 'store']);
Route::get('lang/change/{lan}', [\App\Http\Controllers\LangController::class, 'change'])->name('changeLang');

Route::get('/', [App\Http\Controllers\PostsController::class, 'index'])->name('index');
Route::get('/p/create', [App\Http\Controllers\PostsController::class, 'create']);
Route::get('/p/{post}', [App\Http\Controllers\PostsController::class, 'show']);
Route::post('/p/store', [App\Http\Controllers\PostsController::class, 'store'])->name('post.store');


Route::get('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [App\Http\Controllers\ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}', [App\Http\Controllers\ProfilesController::class, 'update'])->name('profile.update');
Route::get('/findprofile', [App\Http\Controllers\ProfilesController::class, 'findprofile'])->name('profile.findprofile');

Auth::routes();
