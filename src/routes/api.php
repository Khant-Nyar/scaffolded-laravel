<?php

use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () { //->middleware('auth:api')
    //banners
    Route::get('test', function () {
        return "ajoa wjegjw ejg";
    });
    Route::fallback(function () {
        return abort(404);
    });
});
