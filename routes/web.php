<?php

use App\Http\Controllers\SiteController;
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

Route::get('/', [SiteController::class,'welcome']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/sitedangereux', [SiteController::class, 'index']);
Route::get('/sitedangereux/create', [SiteController::class, 'create'])->name('create');
Route::post('/sitedangereux/create', [SiteController::class, 'store'])->name('store');
Route::get('/sitedangereux/create{nom}',[SiteController::class, 'preRemplir'])->name('remplir');
Route::get('/sitedangereux/{id}', [SiteController::class, 'show'])->name('show');
Route::delete('/sitedangereux/{id}', [SiteController::class, 'destroy'])->name('destroy');
Route::post('/sitedangereux/{id}/voter', [SiteController::class, 'voter'])->name('voter');
Route::post('/sitedangereux/{id}/commenter', [SiteController::class, 'commenter'])->name('commenter');
Route::get('/search',[SiteController::class, 'search'])->name('search');
Route::get('/messites',[SiteController::class, 'lister'])->name('lister');



require __DIR__.'/auth.php';
