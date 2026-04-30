<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contents.web.beranda');
});

Route::get('/login', function () {
    return view('contents.auth.login');
});
