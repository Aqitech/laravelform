<?php

use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialsController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\RepliesController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\WatchController;
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

    Route::get('/form', [FormsController::class, 'index'])->name('form');
    Route::get('/channel/{slug}', [FormsController::class, 'channel'])->name('channel');
    Route::get('/discussion/{slug}', [DiscussionController::class, 'show'])->name('discussion.show');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('channels', ChannelController::class);

    Route::get('/discussion/create/new', [DiscussionController::class, 'create'])->name('discussion.create');
    Route::post('/discussion/store', [DiscussionController::class, 'store'])->name('discussion.store');

    Route::post('/discussion/reply/{id}', [DiscussionController::class, 'reply'])->name('discussion.reply');

    Route::get('/reply/dislike/{id}',[RepliesController::class, 'dislike'])->name('reply.dislike');
    Route::get('/reply/like/{id}',[RepliesController::class, 'like'])->name('reply.like');
    Route::get('/discussion/best-answer/{id}',[RepliesController::class, 'best_answer'])->name('discussion.best.answer');

    Route::get('/discussion/watch/{id}', [WatchController::class, 'watch'])->name('discussion.watch');
    Route::get('/discussion/unwatch/{id}', [WatchController::class, 'unwatch'])->name('discussion.unwatch');
});

require __DIR__.'/auth.php';
