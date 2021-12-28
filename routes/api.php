<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/registrar', 'UserController@store');
Route::post('/login', 'UserController@login');

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::get('/logout', 'UserController@logout');

    Route::group(['prefix' => 'usuario'], function () {
        Route::get('/dados', function (Request $req) {
            if ($req->user->foto) {
                $req->user['foto_'] = asset($req->user->foto->url);
            }
            return $req->user;
        });
        Route::post('/foto', 'FotoController@set_foto');
    });
});
