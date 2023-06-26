<?php

use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SongController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;




Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/home/{locale}', [LanguageController::class, 'changeLanguage'])->name('changeLanguage');
Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');


Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('/songs', [SongController::class, 'store'])->name('songs.store');
Route::get('/songs/{song}', [SongController::class, 'show'])->name('songs.show');
Route::get('/songs/{song}/edit', [SongController::class, 'edit'])->name('songs.edit');
Route::put('/songs/{song}', [SongController::class, 'update'])->name('songs.update');
Route::delete('/songs/{song}/delete', [SongController::class, 'destroy'])->name('songs.destroy');
Route::post('/songs/find', [SongController::class, 'find'])->name('songs.find');
Route::post('/song/search', [SongController::class, 'search'])->name('song.search');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add-to-cart/{song_id}', [CartController::class, 'addToCart'])->name('cart.addToCart');


Route::get('/songs/{song}/comments', [CommentController::class, 'index'])->name('comments.show');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('/songs/{song}/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

Route::post('/profile/upload', [HomeController::class, 'uploadProfilePicture'])->name('profile.upload');

Route::post('/likes/add', [LikeController::class, 'addLike'])->name('likes.add');

Route::get('/songs', [SongController::class, 'index'])->name('songs.index');

Route::delete('/cart/remove/{cart_item_id}', [CartController::class, 'removeFromCart'])->name('cart.removeFromCart');


