<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\Http\Controllers\FrontController;


Route::middleware('web')->prefix('front')->group(function () {
    Route::get('/', [FrontController::class,'index'])->name('front.index');
});
