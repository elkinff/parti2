<?php

//Auth redes sociales facebook y google
Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');

//Registro y activacion de usuario
Route::post('register/user', 'Auth\RegisterController@createUser')->name("register.user");
Route::get('activar/{id}/{token}', 'Auth\RegisterController@activarUser')->name("activar.user");

//Muro de publicaciones
Route::get('/', 'HomeController@index')->name('muro');

//Publicar Apuesta
Route::get('publicar', 'PartidoController@index')->name('publicar.partido');

//Publicaciones
Route::get('publicaciones/{idPublicacion}', 'PublicacionController@show')->name('show.publicacion');
Route::get('usuario/publicaciones', 'PublicacionController@publicacionesUsuario')->name('get.publicacionesUsuario');

//--Apis
Route::get('publicaciones', 'PublicacionController@getPublicaciones')->name('get.publicacion');
Route::post('api/publicar', 'PublicacionController@store')->name('publicar');
Route::post('publicaciones/match', 'PublicacionController@match')->name('match.publicacion');
Route::get('partidos', 'PartidoController@getPartidos')->name('get.partido');

//Credito
Route::get('credito', 'CreditoController@index');
Route::post('credito/retirar', 'CreditoController@retirarDinero')->name('credito.retirar');
Route::post('credito/agregar', 'CreditoController@adicionarCredito')->name('credito.agregar');

//Perfil
Route::get('perfil', 'UsuarioController@index')->name("perfil");
Route::post('perfil', 'UsuarioController@actualizarUsuario')->name("perfil.update");

Auth::routes(); 
Route::get('logout', 'Auth\LoginController@logout');
