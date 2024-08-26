<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/dsc-webhook', function(){
    return response()->json(['status' => 'success'], 200, ['Content-Type' => 'application/x-www-urlencoded']);
});
