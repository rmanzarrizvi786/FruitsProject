<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FruitsController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FavouritesController;
use App\Http\Controllers\Admin\SyncController;

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



Auth::routes(['register' => false]);

//Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
Route::get('/', [FruitsController::class, 'index'])->name('fruits');
Route::get('/home', [FruitsController::class, 'index'])->name('fruits');
Route::prefix('fruits')->group(function () {
    Route::get('/', [FruitsController::class, 'index'])->name('fruits');
    Route::get('/get-fruits', [FruitsController::class, 'getFruits'])->name('fruits.get');
    Route::post('get-fruits-single', [FruitsController::class, 'getFruitData'])->name('fruits.show');
    Route::post('fruits/save', [FruitsController::class, 'store'])->name('fruits.store');
    Route::post('fruits/update', [FruitsController::class, 'update'])->name('fruits.update');
    Route::get('delete/{id}', [FruitsController::class, 'destroy'])->name('fruits.destroy');
    Route::post('delete', [FruitsController::class, 'destroy'])->name('fruits.destroy');
});




Route::get('favourites', [FavouritesController::class, 'index'])->name('favourites');
Route::get('get-favourites', [FavouritesController::class, 'getFavourites'])->name('fruits.get.favourites');
Route::post('favourites/add', [FavouritesController::class, 'store'])->name('favourites.add');
Route::post('favourites/delete', [FavouritesController::class, 'destroy'])->name('favourites.destroy');

Route::get('/sync', [SyncController::class, 'index'])->name('fruits.sync');
Route::get('/sync/get', [SyncController::class, 'fruitsSync'])->name('fruits.sync.post');
