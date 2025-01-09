<?php

use App\Http\Controllers\Frontend\CommentController;
use App\Http\Controllers\Frontend\DiagnosticCaseController;
use App\Http\Controllers\Frontend\IndexController;
use Illuminate\Support\Facades\Route;

Route::name('frontend.')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
});

require __DIR__ . '/user.php';
require __DIR__ . '/admin.php';
