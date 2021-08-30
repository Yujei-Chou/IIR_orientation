<?php
use App\Http\Controllers\MovieController;
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



Route::get('/',[ MovieController::class,'listRating'])->name('display');;
Route::get('/import',[ MovieController::class,'importRating'])->name('import');;
Route::get('/clear',[ MovieController::class,'clearRating'])->name('clear');;
Route::post('/delete',[ MovieController::class,'deleteRating'])->name('delete');;
Route::get('/search',[ MovieController::class,'searchRating'])->name('search');;
Route::post('/update',[ MovieController::class,'updateRating'])->name('update');;
Route::post('/recommend',[ MovieController::class,'recommendMovie'])->name('recommend');;
