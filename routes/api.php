<?php

//Pagina de respuesta y de confirmacion epay co publicacion o match 
Route::post('publicaciones/respuestaPasarela', 'PublicacionController@respuestaPasarela')->name('respuesta.publicacion');
Route::post('publicar/confirmacion', 'PublicacionController@confirmacionPasarelaPublicacion')->name('confirmacion.publicar');

//Pagina de respuesta y confirmacion epay co agregar credito
Route::post('credito/agregar/respuesta', 'CreditoController@respuestaPasarela')->name('respuesta.credito.agregar');
Route::post('credito/agregar/confirmacion', 'ApiController@confirmacionPasarelaCredito')->name('confirmacion.credito.agregar');