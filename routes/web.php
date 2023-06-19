<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SongController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Auth::routes();


Route::get('/songs/create', [SongController::class, 'create'])->name('songs.create');
Route::post('/songs', [SongController::class, 'store'])->name('songs.store');



Route::get('/upload/music', [MusicController::class, 'upload'])->name('upload.music');
Route::get('/publish/photos', [PhotoController::class, 'publish'])->name('publish.photos');
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
Route::get('/manage/products', [ProductController::class, 'manage'])->name('manage.products');
Route::get('/edit/publications', [PublicationController::class, 'edit'])->name('edit.publications');
Route::get('/comment/publications', [PublicationController::class, 'comment'])->name('comment.publications');
Route::get('/purchase/publications', [PublicationController::class, 'purchase'])->name('purchase.publications');
Route::get('/add/keywords', [KeywordController::class, 'add'])->name('add.keywords');
Route::get('/follow/profiles', [ProfileController::class, 'follow'])->name('follow.profiles');

Route::get('/music/create', [MusicController::class, 'create'])->name('music.create');
Route::post('/music', [MusicController::class, 'store'])->name('music.store');
