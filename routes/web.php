<?php

use App\Http\Controllers\MqttController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/publish-timestamp', [MqttController::class, 'publishTimestamp']);
