<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

//auth page change lang
Route::get('lang-ar', function (){
    session()->put('lang', 'ar');
    return back();
});

Route::get('lang-en', function (){
    session()->put('lang', 'en');
    return back();
});


require __DIR__.'/auth.php';
Route::get('/explore', [PostController::class, 'explore'])->name('explore')->middleware(\App\Http\Middleware\ChangeLanguage::class);
Route::middleware(['auth' , \App\Http\Middleware\ChangeLanguage::class])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/{user:username}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{user:username}', function (){
        abort(403, 'Where are you going?');
    });

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

//    Follow
    Route::get('/{user:username}/follow', [ProfileController::class, 'follow'])->name('follow_user');
//    Unfollow
    Route::get('/{user:username}/unfollow', [ProfileController::class, 'unfollow'])->name('unfollow_user');
});
//    User Profile For Public
Route::get('/{user:username}', [ProfileController::class, 'index'])->name('user_profile');

Route::controller(PostController::class)->middleware(['auth', \App\Http\Middleware\ChangeLanguage::class])->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('home');
    Route::get('/p/create', 'create')->name('create_post');
    Route::post('/p/create', 'store')->name('store_post');
    Route::get('/p/{post:slug}', 'show')->name('show_post');
    Route::get('/p/{post:slug}/edit', 'edit')->name('edit_post');
    Route::patch('/p/{post:slug}/update', 'update')->name('update_post');
    Route::get('/p/{post:slug}/update', function (){
        abort(403, 'Where are you going?');
    });
    Route::delete('/p/{post:slug}/delete', 'destroy')->name('delete_post');
//    likes
    Route::get('/p/{post:slug}/like',LikeController::class);
});

Route::post('/p/{post:slug}/comment', [CommentController::class, 'store'])->name('store_comment')->middleware(['auth', \App\Http\Middleware\ChangeLanguage::class]);

