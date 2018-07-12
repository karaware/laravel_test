<?php

namespace App\Providers;

use App\Http\Validators\HelloValidator;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class HelloServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $validator = $this->app['validator'];
        $validator->resolver(function($translator, $data, $rules, $messages){
            return new HelloValidator($translator, $data, $rules, $messages);
        });
        //View::composer(
            //'hello.index', 'App\Http\Composers\HelloComposer'
        //);
    }
}
