<?php

use App\Http\Controllers\BasicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BasicController::class, 'ipCheck'])->name('ipCheck');
Route::post('/', [BasicController::class, 'ipCheckPost'])->name('ipCheck.post');

Route::get('/checkIp/{ip}', [BasicController::class, 'ipCheckRes']);