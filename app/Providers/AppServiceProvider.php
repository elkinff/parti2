<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\UrlGenerator;
use Auth;

class AppServiceProvider extends ServiceProvider{

    public function boot(){
        if(env('APP_ENV') == 'production') {
            \URL::forceScheme('https');
        }

        Validator::extend('menor_saldo', function($attribute, $value, $parameters, $validator) {
            return (Auth::user()->saldo >= str_replace(str_split('$,'), "", $value));
        });

        Schema::defaultStringLength(191);
    }

    public function register()
    {
        //
    }
}
