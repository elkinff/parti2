<?php

Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

Route::get('/', 'HomeController@index')->name('muro');


Route::get('/ejemplo', function () {
    return view('pages.dashboard.example');
});

Route::get('/credito', function () {
    return view('pages.dashboard.credito');
});


Route::get('/email', function () {
    return view('emails.bienvenida');
});


Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
