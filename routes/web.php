<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/gallery', [GalleryController::class, 'index'])->middleware(['auth', 'verified'])->name('gallery');
Route::get('/gallery/{foto_id}', [GalleryController::class, 'show'])->middleware(['auth', 'verified'])->name('gallery.detail');

Route::get('/mygallery',[FotoController::class, 'index'])->middleware(['auth', 'verified'])->name('mygallery');
Route::get('/mygallery/create',[FotoController::class, 'create'])->middleware(['auth', 'verified'])->name('mygallery.create');
Route::post('/mygallery',[FotoController::class, 'store'])->middleware(['auth', 'verified'])->name('mygallery.store');
Route::get('/mygallery/{foto_id}', [FotoController::class, 'show'])->middleware(['auth', 'verified'])->name('mygallery.show');
Route::get('/mygallery/{foto_id}/edit', [FotoController::class, 'edit'])->middleware(['auth', 'verified'])->name('mygallery.edit');
Route::put('/mygallery/{id}', [FotoController::class, 'update'])->middleware(['auth', 'verified'])->name('mygallery.update');
Route::delete('/mygallery/{id}', [FotoController::class, 'destroy'])->middleware(['auth', 'verified'])->name('mygallery.delete');

Route::post('/like', [LikeController::class, 'like'])->middleware(['auth', 'verified'])->name('like');
Route::delete('/like/{like_id}', [LikeController::class, 'dislike'])->middleware(['auth', 'verified'])->name('dislike');

Route::post('/komentar', [KomentarController::class, 'store'])->middleware(['auth', 'verified'])->name('komentar.store');
Route::delete('/komentar/{foto_id}', [KomentarController::class, 'delete'])->middleware(['auth', 'verified'])->name('komentar.delete');

Route::get('/album',[AlbumController::class, 'index'])->middleware(['auth', 'verified'])->name('album');
Route::get('/album/create',[AlbumController::class, 'create'])->middleware(['auth', 'verified'])->name('album.create');
Route::post('/album',[AlbumController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('/album/{album_id}', [AlbumController::class, 'show'])->middleware(['auth', 'verified']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
