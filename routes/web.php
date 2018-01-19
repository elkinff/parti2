<?php



Route::get('/login', function () {
    return view('pages.auth.login');
});

Route::get('/register', function () {
    return view('pages.auth.register');
});

Route::get('/recuperar', function () {
    return view('pages.auth.recuperar');
});

Route::get('/ejemplo', function () {
    return view('pages.dashboard.example');
});


Route::get('/email', function () {
    return view('emails.bienvenida');
});



Route::get('auth/{provider}', 'Auth\SocialAuthController@redirectToProvider')->name('social.auth');
Route::get('auth/{provider}/callback', 'Auth\SocialAuthController@handleProviderCallback');


Route::get('home', 'HomeController@index')->name('home');
Auth::routes();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
