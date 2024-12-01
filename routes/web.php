<?php

use App\Http\Controllers\CitizenControlller;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::resource('/user',CitizenControlller::class);