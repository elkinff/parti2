<?php

//Pagina de respuesta epay co
Route::post('publicaciones/detalle', 'PublicacionController@respuestaPaserela')->name('respuesta.publicacion');

//Pagina de confirmacion epay
Route::post('publicar/confirmacion', 'PublicacionController@confirmacionPasarela')->name('confirmacion.publicar');

