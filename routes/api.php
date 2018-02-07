<?php

//Pagina de respuesta epay co
Route::post('publicaciones/detalle', 'PublicacionController@show')->name('show.publicacion');

//Pagina de confirmacion epay co
Route::post('publicar/confirmacion', 'PublicacionController@confirmacionPasarela')->name('confirmacion.publicar');

