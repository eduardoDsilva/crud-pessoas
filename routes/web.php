<?php

use Illuminate\Support\Facades\Route;
use App\Jobs\EnviarEmailFake;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste-fila', function () {
    dispatch(new EnviarEmailFake('eduardo@example.com'));

    return 'Job enviado!';
});
