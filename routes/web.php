<?php

use App\Http\Controllers\FileUploadController;
use Illuminate\Support\Facades\Route;

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

Route::get('files', [FileUploadController::class, 'index'])->name('files.index');
Route::get('files/download', [FileUploadController::class, 'download'])->name('files.download');

Route::get('files/upload', [FileUploadController::class, 'create'])->name('files.create');
Route::post('files/upload', [FileUploadController::class, 'upload'])->name('files.upload');
