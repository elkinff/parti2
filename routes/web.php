<?php

//Auth redes sociales facebook y google
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//Registro y activacion de usuario
Route::post('register/user', 'Auth\RegisterController@createUser')->name("register.user");
Route::get('activar/{id}/{token}', 'Auth\RegisterController@activarUser')->name("activar.user");

//Parti2
Route::get('/', 'HomeController@index')->name('muro');

//Publicar Partido y publicacion
Route::get('publicar', 'PartidoController@index')->name('publicar.partido');
Route::get('partidos', 'PartidoController@getPartidos')->name('get.partido');
Route::post('api/publicar', 'PublicacionController@store')->name('publicar');
Route::get('publicaciones/{idPublicacion}', 'PublicacionController@show')->name('show.publicacion');

//Credito
Route::get('credito', 'CreditoController@index');


Route::get('/email', function () {
    return view('emails.email-example');
});


Route::get('/ejemplo', function () {
    return view('pages.dashboard.example');
});

Route::get('/detalle', function () {
    return view('pages.dashboard.detalle-publicacion');
});



Auth::routes();
Route::get('logout', 'Auth\LoginController@logout');
