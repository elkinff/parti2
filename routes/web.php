<?php

//Auth redes sociales facebook y google
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//Registro y activacion de usuario
Route::post('register/user', 'Auth\RegisterController@createUser')->name("register.user");
Route::get('activar/{id}/{token}', 'Auth\RegisterController@activarUser')->name("activar.user");

//Parti2
Route::get('/', 'HomeController@index')->name('muro');

//Publicar Partido
Route::get('publicar', 'PartidoController@index')->name('publicar.partido');
Route::get('partidos', 'PartidoController@getPartidos')->name('get.partido');

//Credito
Route::get('credito', 'CreditoController@index');


Route::get('/email', function () {
    return view('emails.email-example');
});


Route::get('/ejemplo', function () {
    return view('pages.dashboard.example');
});



Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
