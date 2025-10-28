<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LangLocale
{
    public function handle($request, Closure $next)
    {
        // dd(App::currentLocale());
        App::setLocale(Session::get('locale', config('app.locale')));

        return $next($request);
    }
}
