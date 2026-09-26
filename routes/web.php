<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('discussions.index');
});


Route::resource('discussions', DiscussionController::class);
Route::post('/discussions/{discussion}/replies',[ReplyController::class,'store'])->name('replies.store');
Route::delete('/replies/{reply}',[ReplyController::class,'destroy'])->name('replies.destroy');
Route::resource('announcements', announcementController::class);

