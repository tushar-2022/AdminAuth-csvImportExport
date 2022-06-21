<?php

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/import_export', [App\Http\Controllers\FileController::class, 'getImport'])->name('import_export');
    Route::post('/import_parse', [App\Http\Controllers\FileController::class, 'parseImport'])->name('import_parse');
    Route::post('/export_products', [App\Http\Controllers\FileController::class, 'exportProducts'])->name('export_products');
    Route::any('/download-file', [App\Http\Controllers\FileController::class, 'downloadDemoFile'])->name('download-file');
});