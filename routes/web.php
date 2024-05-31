<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\tampilController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\PertanyaanController;
use App\Http\Controllers\exportController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/postlogin', [AuthController::class, 'postlogin']);
Route::get('/register', [AuthController::class, 'register']);
Route::post('/postregister', [AuthController::class, 'postregister']);
Route::get('/logout', [AuthController::class, 'logout']);

//middleware untuk role admin
Route::middleware(['web','auth', 'role:admin'])->group(function () {
    Route::get('/', [profileController::class, 'index']);
    // table pertanyaan
    Route::resource('pertanyaan', PertanyaanController::class);
    Route::get('/pertanyaan/{show}', [profileController::class, 'ShowPertanyaan']); // show admin untuk pertanyaan use
    Route::resource('profile', profileController::class);

    Route::delete('/hapus/{hapus}', [jawabanController::class, 'Destroy']);
    Route::resource('jawaban', jawabanController::class);

     // Export pdf pertanyaan & jawban
    Route::get('/exportPertanyaan', [exportController::class, 'PDFPertanyaan']);
    Route::get('/ExcelPertanyaan', [exportController::class, 'ExcelPertanyaan']);

  
});

// untuk user
Route::middleware(['auth', 'role:users,admin','web'])->group(function () {
    Route::get('/', [tampilController::class, 'index']);
    Route::resource('kategori', KategoriController::class);
    Route::post('/kategori/store', [KategoriController::class, 'store']);

    Route::get('/forum/create', [ForumController::class, 'create']);
    Route::get('/forum/show/{id}', [ForumController::class, 'show']);
    Route::post('/forum/store', [ForumController::class, 'store']);

    Route::post('/forum/jawaban/{id}', [ForumController::class, 'jawab']);
    Route::post('/forum/komentar_pertanyaan/{id}', [ForumController::class, 'komentar_pertanyaan']);
    Route::post('/forum/komentar_jawaban/{id}', [ForumController::class, 'komentar_jawaban']);
    Route::get('/forum/edit/{id}', [ForumController::class, 'edit']); // edit
    Route::get('/forum/edit2/{id}', [ForumController::class, 'edit2']);
    Route::post('/forum/update/{id}', [ForumController::class, 'update']); // update
    Route::patch('/forum/update/{id}', [ForumController::class, 'update2']);
    Route::post('/forum/hapus/{id}', [ForumController::class, 'destroy']); // delete
    Route::delete('/forum/hapus/{id}', [ForumController::class, 'destroy2']);
    Route::get('/following/{id}', [ForumController::class, 'follower']);
});