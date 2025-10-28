<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class LangLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        // dd(App::currentLocale());
        App::setLocale(Session::get('locale', config('app.locale')));

        return $next($request);
    }
}
