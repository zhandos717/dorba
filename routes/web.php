<?php

use Illuminate\Support\Facades\Route;


Route::get('test', function () {

   return app(
        \App\Services\Kaypu\KaypuBarCodeService::class)->getInfo();

});

Route::get('{all}', function () {
    return view('app');
})->where(['all' => '^(?!api|storage).*$']);
