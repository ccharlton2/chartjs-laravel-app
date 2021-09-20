<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChartJsController;
use App\Http\Controllers\SiteAnalyticsController;

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

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/site-analysis', [SiteAnalyticsController::class, 'index'])->name('site-analysis');
    Route::post('/site-analysis', [SiteAnalyticsController::class, 'index']);
});

require __DIR__ . '/auth.php';
