<?php

//Pagina de respuesta epay co publicacion o match 
Route::post('publicaciones/detalle', 'PublicacionController@respuestaPasarela')->name('respuesta.publicacion');

//Pagina de respuesta epay co agregar credito
Route::post('credito/agregar/respuesta', 'PublicacionController@respuestaPasarela')->name('respuesta.credito.agregar');

//Pagina de confirmacion epay co publicacion o match
Route::post('publicar/confirmacion', 'PublicacionController@confirmacionPasarela')->name('confirmacion.publicar');

//Pagina de confirmacion epay co agregar credito
Route::post('credito/agregar/confirmacion', 'CreditoController@confirmacionPasarela')->name('confirmacion.credito.agregar');

