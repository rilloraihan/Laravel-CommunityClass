<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DiscussionController; // Tambahkan impor ini
use App\Http\Controllers\ReplyController;      // Tambahkan impor ini
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/discussions', [DiscussionController::class, 'index'])->name('discussions.index');
Route::get('/discussions/create', [DiscussionController::class, 'create'])
    ->name('discussions.create')
    ->middleware('auth');
Route::post('/discussions', [DiscussionController::class, 'store'])
    ->name('discussions.store')
    ->middleware('auth');
Route::get('/discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussions.show');
Route::get('/discussions/{discussion}/edit', [DiscussionController::class, 'edit'])
    ->name('discussions.edit')
    ->middleware('auth');


Route::put('/discussions/{discussion}', [DiscussionController::class, 'update'])
    ->name('discussions.update')
    ->middleware('auth');


Route::delete('/discussions/{discussion}', [DiscussionController::class, 'destroy'])
    ->name('discussions.destroy')
    ->middleware('auth');


Route::post('/discussions/{discussion}/replies', [ReplyController::class, 'store'])
    ->name('replies.store')
    ->middleware('auth');
Route::delete('/replies/{reply}', [ReplyController::class, 'destroy'])
    ->name('replies.destroy')
    ->middleware('auth');
Route::get('/my-discussions', [DiscussionController::class, 'myDiscussions'])
    ->name('discussions.my')
    ->middleware('auth');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index');
    Route::get('/announcements/create', [\App\Http\Controllers\AnnouncementController::class, 'create'])->name('announcements.create');
    Route::post('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'store'])->name('announcements.store');
});
Route::get('/announcements', [\App\Http\Controllers\AnnouncementController::class, 'index'])->name('announcements.index')->middleware('auth');

Route::get('/announcements/{announcement}/edit', [\App\Http\Controllers\AnnouncementController::class, 'edit'])->name('announcements.edit');
Route::put('/announcements/{announcement}', [\App\Http\Controllers\AnnouncementController::class, 'update'])->name('announcements.update');
Route::delete('/announcements/{announcement}', [\App\Http\Controllers\AnnouncementController::class, 'destroy'])->name('announcements.destroy');

require __DIR__.'/auth.php';
