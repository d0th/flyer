<?php
use Illuminate\Http\Request;

Route::get('/auth', 'Api\ApiController@getAuth');
Route::get('/getUser', 'Api\ApiController@getUser');

Route::get('/login', 'Auth\LoginController@showLoginForm');
Route::post('/login', 'Auth\LoginController@validLoginForm');
