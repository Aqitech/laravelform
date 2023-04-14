<?php

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\FormsController;
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

Route::get('login/{provider}', [SocialsController::class, 'redirect'])->name('social.login');
Route::get('login/{provider}/callback', [SocialsController::class, 'Callback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    Route::resource('channels', ChannelController::class);

    Route::get('/discussion/create', [DiscussionController::class, 'create'])->name('discussion.create');
    Route::post('/discussion/store', [DiscussionController::class, 'store'])->name('discussion.store');
    Route::get('/discussion/{slug}', [DiscussionController::class, 'show'])->name('discussion.show');

    Route::get('/form', [FormsController::class, 'index'])->name('form');
});

require __DIR__.'/auth.php';
